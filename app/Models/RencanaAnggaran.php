<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaAnggaran extends Model
{

    protected $fillable = [
        'jenis_anggaran',
        'sumber_anggaran',
        'nominal_anggaran',
    ];

    use HasFactory;
}
