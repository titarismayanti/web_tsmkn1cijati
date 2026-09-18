<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Artikel extends Model
{
    use HasFactory;
    protected $table = 'artikels';
    protected $fillable = [
        'judul',
        'slug',
        'isi',
        'gambar',
        'tanggal_publish',
        'kategori_artikel_id'
    ];

    public function kategori()
{
    return $this->belongsTo(
        ArtikelKategori::class,
        'kategori_artikel_id'
    );
}

}
