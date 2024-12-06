<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */

     protected $fillable = [
        'nama_pemilik',
        'mesin_id',
        'no_hp',
        'tanggal',
        'tempat',
        'jenis_jasa',
     ];
}
