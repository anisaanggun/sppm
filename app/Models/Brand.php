<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand_name',
    ];

    // Definisikan relasi dengan model DataMesin
    public function dataMesins()
    {
        return $this->hasMany(DataMesin::class, 'brand_id');
    }
}
