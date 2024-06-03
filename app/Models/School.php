<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;
    protected $fillable = [
        'name' ,
         'type' ,
         'age_stage' ,
         'Subscription_price' ,
         'address' ,
    ];

    public function users()
    {
        return $this->hasMany(User::class) ;
    }
    public function exams()
    {
        return $this->hasmany(Exam::class) ;
    }
    public function libraries()
    {
        return $this->hasmany(Librarie::class) ;
    }
    public function stages()
    {
        return $this->hasMany(Stage::class) ;
    }
    public function certificates()
    {
    return $this->hasMany(Certificate::class);
    }
}
