<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilSekolah extends Model
{
    protected $table = 'profils';

    protected $fillable = [
        'nama_sekolah',
        'akreditasi',
        'sejarah',
        'visi',
        'misi',
        'alamat',
        'telephone',
        'email',
    ];
}
