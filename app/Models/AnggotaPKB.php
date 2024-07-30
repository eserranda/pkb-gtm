<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaPKB extends Model
{

    protected $fillable = [
        'id_klasis',
        'id_jemaat',
        'nama_anggota',
        'kelompok',
    ];

    public function klasis()
    {
        return $this->belongsTo(Klasis::class, 'id_klasis');
    }

    public function jemaat()
    {
        return $this->belongsTo(Jemaat::class, 'id_jemaat');
    }
    use HasFactory;
}