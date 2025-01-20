<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTeknisi extends Model
{
    use HasFactory;

    protected $table = "data_teknisis";

    protected $fillable = [
        'user_id',
        'name',
        'no_hp',
        'alamat',
        'email',
    ];
}
