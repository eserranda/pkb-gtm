<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klasis extends Model
{

    protected $fillable = [
        'wilayah',
        'nama_klasis',
        'koordinator',
        'no_telp',
        'alamat',
    ];

    use HasFactory;
}
