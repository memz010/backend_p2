<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;
    protected $fillable = [
        'school_id',
        'user_id',
        'title',
        'description' ,
        'file' ,
    ];
    public function user()
    {
        return $this->belongsToMany(User::class,'certificates');
    }

    public function school()
    {
        return $this->belongsToMany(School::class,'certificates');
    }


}
