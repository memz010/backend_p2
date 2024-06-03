<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    use HasFactory;
    protected $fillable = [
        'guardian_id' ,
        'student_id' ,
    ];

    public function students()
    {
        return $this->belongsToMany(User::class , 'guardians');
    }

    public function guardians()
    {
        return $this->belongsToMany(User::class , 'guardians');
    }
}
