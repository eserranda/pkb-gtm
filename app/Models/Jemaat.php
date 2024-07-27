<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jemaat extends Model
{
    protected $fillable = [
        'id_klasis',
        'nama_jemaat',
        'pelayan',
        'alamat',
    ];

    public function klasis()
    {
        return $this->belongsTo(Klasis::class, 'id_klasis');
    }

    use HasFactory;
}
