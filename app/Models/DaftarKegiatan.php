<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarKegiatan extends Model
{

    protected $fillable = [
        'nama_kegiatan',
    ];

    use HasFactory;
}