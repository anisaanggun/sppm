<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataMesin extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemilik',
        'nama_mesin',
        'brand',
        'model',
    ];
}
