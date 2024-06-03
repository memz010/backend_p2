<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'guardian_id' ,
        'teacher_id' ,
        'message',
    ];
    public function teachers()
    {
        return $this->belongsToMany(User::class,'messages');
    }
    public function guardians()
    {
        return $this->belongsToMany(User::class , 'messages');
    }
}
