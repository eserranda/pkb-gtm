<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class UserJemaatController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $userRoles = Auth::user()->roles->pluck('name')->toArray();  
            // if (array_intersect($userRoles, ['klasis', 'admin', 'supervisor'])) {
            //     $data = User::latest('created_at')->get();
            //     return response()->json($data);
            // }

            if (Auth::user()->hasAnyRole(['super_admin'])) {
                $data = User::whereHas('roles', function ($query) {
                    $query->where('name', 'jemaat');
                })->latest('created_at')->get();
            } else if (Auth::user()->hasAnyRole(['jemaat'])) {
                $id_jemaat = Auth::user()->id_jemaat;
                $data = User::where('id_jemaat', $id_jemaat)->latest('created_at')->get();
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('role', function ($user) {
                    return $user->roles->pluck('name')->implode(', ');
                })
                ->addColumn('action', function ($row) {
                    // $btn = '<a class="btn btn-outline-secondary btn-sm" title="Edit" onclick="edit(' . $row->id . ')"> <i class="fas fa-pencil-alt"></i> </a>';
                    $btn = '<a class="btn btn-outline-secondary btn-sm  text-danger mx-2" title="Hapus" onclick="hapus(' . $row->id . ')"> <i class="fas fa-trash-alt"></i> </a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.users-jemaat.index');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_jemaat' => 'required',
            'name' => 'required|string|max:255',
            'username' => ['required', 'string', 'max:255', 'unique:users', 'regex:/^\S*$/u'],
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            // 'roles' => 'required|array',
            // 'roles.*' => 'exists:roles,name',
        ], [
            'id_jemaat.required' => 'Klasis Tidak Boleh Kosong',
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
            'id_jemaat' => $request->id_jemaat,
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $roles = ['jemaat'];
        $user->roles()->attach(Role::whereIn('name',  $roles)->get());

        return response()->json([
            'success' => true,
            'message' => 'Registrasi Berhasil'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}