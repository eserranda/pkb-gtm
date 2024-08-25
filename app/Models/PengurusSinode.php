<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengurusSinode extends Model
{
    protected $fillable = [
        'nama',
        'jabatan',
        'no_tlp',
        'tahun_mulai',
        'tahun_selesai',
    ];

    use HasFactory;
}
