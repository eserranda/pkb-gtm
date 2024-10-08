<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{

    protected $fillable = [
        'nama_program',
        'bidang',
        'tujuan',
        'bentuk',
        'sumber_anggaran',
        'penanggung_jawab',
        'biaya',
        'waktu',
        'tempat',
    ];

    use HasFactory;
}
