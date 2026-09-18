<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{

    protected $table = 'jurusans';

    protected $fillable = [
        'nama_jurusan',
        'guru_id',
        'singkatan',
        'deskripsi',
        'gambar',
    ];

    public function kepalaProgram()
    {
        return $this->belongsTo(
            Guru::class,
            'guru_id'
        );
    }
}