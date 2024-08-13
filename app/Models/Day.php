<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;
    protected $fillable = [
        'day_1', 'day_2', 'day_3', 'day_4', 'day_5', 'day_6', 'day_7',
    ];
}
