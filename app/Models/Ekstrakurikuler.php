<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Guru;

class Ekstrakurikuler extends Model
{
    protected $table = 'ekstrakurikulers';

    protected $fillable = [
        'nama_eskul',
        'guru_id',
        'deskripsi',
        'logo',
    ];

    public function guru()
    {
        return $this->belongsTo(
            Guru::class,
            'guru_id',
            'id'
        );
    }
}
