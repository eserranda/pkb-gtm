<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaJemaat extends Model
{
    protected $fillable = [
        'id_jemaat',
        'nama_anggota',
        'gender',
        'alamat',
        'status_tempat_tinggal',
        'no_telp',
        'mulai_berjemaat',
        'status_pernikahan',
        'tempat_lahir',
        'tgl_lahir',
        'pendidikan',
        'pekerjaan',
        'baptis',
        'sidi',
        'nama_ayah',
        'nama_ibu',
        'tgl_pernikahan',
        'keterangan'
    ];

    public function jemaat()
    {
        return $this->belongsTo(Jemaat::class, 'id_jemaat');
    }

    use HasFactory;
}
