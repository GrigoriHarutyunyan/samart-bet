<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LottoDrawn extends Model
{
    use HasFactory;

    protected $fillable = [
        'machine_balls',
        'user_balls',
    ];

    protected $casts = [
        'machine_balls' =>'array',
        'user_balls' => 'array',
    ];
}
