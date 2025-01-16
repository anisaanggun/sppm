<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPelanggan extends Model
{
    use HasFactory;

    protected $table = "data_pelanggans";

    protected $fillable = [
        'user_id',
        'nama',
        'no_hp',
        'alamat',
        'email',
    ];
}
