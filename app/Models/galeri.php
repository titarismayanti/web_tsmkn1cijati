<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeri';

    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal_publish',
        'gambar',
    ];

    protected $casts = [
        'tanggal_publish' => 'date',
    ];
}