<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemilikMesin extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'mesin_id',
    ];
}
