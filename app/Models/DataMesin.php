<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataMesin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_mesin',
        'brand_id',
        'model',
        'deskripsi',
        'image',
    ];

    // Definisikan relasi dengan model Brand
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
}
