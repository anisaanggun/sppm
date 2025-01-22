<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DataPelanggan;
use App\Models\DataMesin;


class DataPerawatan extends Model
{
    use HasFactory;

    protected $table = "data_perawatans";

    protected $fillable = [
        'pemilik_id',
        'no_hp',
        'alamat',
        'mesin_id',
        'user_id',
        'tanggal_perawatan',
        'aktivitas',
        'catatan',
        'status_perawatan',
    ];

    // Relasi ke model Pemilik
    public function pemilik()
    {
        return $this->belongsTo(DataPelanggan::class, 'pemilik_id');
    }

    // Relasi ke model Mesin
    public function mesin()
    {
        return $this->belongsTo(DataMesin::class, 'mesin_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');  // Relasi  berdasarkan user_id
    }
}
