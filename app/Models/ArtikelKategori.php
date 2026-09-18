<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ArtikelKategori extends Model
{
    use HasFactory;
    protected $table = 'artikel_kategoris';
    protected $fillable = [
        'nama_kategori'
    ];
}
