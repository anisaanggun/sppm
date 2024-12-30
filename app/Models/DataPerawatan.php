<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPerawatan extends Model
{
    use HasFactory;
    protected $fillable = [
        'pemilik',
        'teknisi',
        'mesin_id',
        'user_id',
        'tanggal_perawatan',
        'aktivitas',
        'catatan',
    ];
}
