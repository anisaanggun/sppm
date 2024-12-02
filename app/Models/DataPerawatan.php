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
        'nama_mesin',
        'tanggal_perawatan',
        'aktivitas',
        'catatan',
    ];
}
