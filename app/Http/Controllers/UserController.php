<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::whereHas('roles', function ($query) {
                $query->where('name', '!=', 'jemaat')
                    ->where('name', '!=', 'klasis');
            })->latest('created_at')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('role', function ($user) {
                    return $user->roles->pluck('name')->implode(', ');
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a class="btn btn-outline-secondary btn-sm" title="Edit" onclick="edit(' . $row->id . ')"> <i class="fas fa-pencil-alt"></i> </a>';
                    $btn .= '<a class="btn btn-outline-secondary btn-sm  text-danger mx-2" title="Hapus" onclick="hapus(' . $row->id . ')"> <i class="fas fa-trash-alt"></i> </a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.users.index');
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = [$loginType => $request->login, 'password' => $request->password];

        if (RateLimiter::tooManyAttempts($this->throttleKey($request), 3)) {
            $seconds = RateLimiter::availableIn($this->throttleKey($request));

            $minutes = floor($seconds / 60);
            $seconds %= 60;

            $time = sprintf('%02d menit %02d detik', $minutes, $seconds);

            return redirect()->back()->withErrors(['login' => "Terlalu banyak percobaan! Akun Anda terblokir sementara, Silakan coba lagi dalam {$time}"])->withInput();
        }

        if (Auth::attempt($credentials)) {
            RateLimiter::clear($this->throttleKey($request));
            return redirect()->intended('/dashboard');
        }

        RateLimiter::hit($this->throttleKey($request), 120);

        return redirect()->back()->withErrors(['login' => 'Username atau Password salah!'])->withInput();
    }

    protected function throttleKey(Request $request)
    {
        return strtolower($request->input('login')) . '|' . $request->ip();
    }

    public function findById($id)
    {
        $data = User::find($id);
        return response()->json($data);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => ['required', 'string', 'max:255', 'unique:users', 'regex:/^\S*$/u'],
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name',
        ], [
            'name.required' => 'Nama Tidak Boleh Kosong',
            'username.required' => 'Username Tidak Boleh Kosong',
            'email.required' => 'Email Tidak Boleh Kosong',
            'password.required' => 'Password Tidak Boleh Kosong',
            'roles.required' => 'Role Tidak Boleh Kosong',
            'password.confirmed' => 'Konfirmasi Password Tidak Sesuai',
            'roles.*.exists' => 'Role Tidak Valid',
            'username.unique' => 'Username Sudah Digunakan',
            'username.regex' => 'Username Tidak Valid',
            'email.unique' => 'Email Sudah Digunakan',
            'email.email' => 'Email Tidak Valid',
            'password.min' => 'Password Minimal 8 Karakter'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->roles()->attach(Role::whereIn('name', $request->roles)->get());

        return response()->json([
            'success' => true,
            'message' => 'Registrasi Berhasil'
        ], 200);
    }


    public function update(Request $request)
    {
        $id = $request->id;
        $validator = Validator::make($request->all(), [
            'edit_name' => 'required|string|max:255',
            'edit_username' => 'required|string|max:255|unique:users,username,' . $id,
            'edit_email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'edit_roles' => 'required|array',
            'edit_roles.*' => 'exists:roles,name',
        ], [
            'edit_name.required' => 'Nama Tidak Boleh Kosong',
            'edit_username.required' => 'Username Tidak Boleh Kosong',
            'edit_email.required' => 'Email Tidak Boleh Kosong',
            'edit_roles.required' => 'Role Tidak Boleh Kosong',
            'edit_roles.*.exists' => 'Role Tidak Valid',
            'edit_username.unique' => 'Username Sudah Digunakan',
            'edit_email.unique' => 'Email Sudah Digunakan',
            'edit_email.email' => 'Email Tidak Valid',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $validator->errors()
            ], 422);
        }

        $update = User::where('id', $id)->update([
            'name' => $request->edit_name,
            'username' => $request->edit_username,
            'email' => $request->edit_email,
        ]);

        $user = User::find($id);
        $user->roles()->sync(Role::whereIn('name', $request->edit_roles)->get());


        if ($update) {
            return response()->json([
                'success' => true,
                'messages' => 'Program berhasil diubah'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'messages' => 'Program gagal diubah'
            ], 409);
        }
    }

    public function destroy(User $users, $id)
    {
        try {
            $deleted = $users::findOrFail($id);
            $deleted->delete();

            return response()->json(['status' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Gagal menghapus data'], 500);
        }
    }
}
