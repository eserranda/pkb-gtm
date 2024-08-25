<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanSinode extends Model
{
    protected $fillable = [
        'nama_kegiatan',
        'image',
        'tempat',
        'waktu',
        'keterangan',
    ];

    use HasFactory;
}
