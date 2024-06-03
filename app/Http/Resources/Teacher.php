<?php

namespace App\Http\Resources;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use  App\Http\Resources\Teacher as TeacherResource;

class Teacher extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Full Name Teacher' => $this->name,
            'Father Name Teacher' => $this->father_name,
            'E-mail' => $this-> email,
            'Gender '=> $this-> gender,
            'Nationality' =>$this -> nationality,
            'role' => $this->role,
            'Birth_Day' => $this-> birth_day,
            'Name OF School ' => $this->school->name,
        ];
    }
}
