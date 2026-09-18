<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guru extends Model
{
    use HasFactory;
    protected $table = 'gurus';
    protected $fillable = [
        'nip',
        'nama_guru',
        'jabatan',
        'jenis_kelamin',
    ];
    
    public function ekstrakurikulers()
    {
        return $this->hasMany(Ekstrakurikuler::class);
    }

    public function jurusans()
    {
        return $this->hasMany(jurusan::class);
    }

}
