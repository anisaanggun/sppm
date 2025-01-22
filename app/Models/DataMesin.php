<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataMesin extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemilik_id',
        'no_hp',
        'user_id',
        'nama_mesin',
        'brand_id',
        'model',
        'pemilik_id',
        'deskripsi',
        'image',
    ];

    // Definisikan relasi dengan model Brand
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    // Relasi ke model Pemilik
    public function pemilik()
    {
        return $this->belongsTo(DataPelanggan::class, 'pemilik_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
