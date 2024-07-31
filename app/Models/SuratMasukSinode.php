<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasukSinode extends Model
{

    protected $fillable = [
        'nomor_surat',
        'tanggal',
        'perihal',
        'alamat_pengirim',
        'tindak_lanjut',
    ];

    use HasFactory;
}
