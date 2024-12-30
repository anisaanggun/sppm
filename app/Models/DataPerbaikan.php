<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPerbaikan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemilik',
        'mesin_id',
        'user_id',
        'tanggal',
        'teknisi',
        'kerusakan',
        'catatan',
    ];
}
