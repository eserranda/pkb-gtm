<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalIbadah extends Model
{

    protected $fillable = [
        'id_jemaat',
        'id_anggota_pkb',
        'kelompok',
        'tanggal',
        'pelayan_firman',
        'mc',
        'persembahan',
        'kolektan',
        'lelang',
        'tempat_ibadah',
    ];

    public function anggota()
    {
        return $this->belongsTo(AnggotaPKB::class, 'id_anggota_pkb', 'id');
    }

    use HasFactory;
}
