<?php

namespace App\Http\Resources;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use  App\Http\Resources\School as SchoolResource;
use  App\Http\Resources\User as UserResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ID Of Students' => $this->id ,
            'Full Name Student' => $this->name,
            'Father Name Student' => $this->father_name,
            'E-mail' => $this-> email,
            'Gender '=> $this-> gender,
            'Nationality' =>$this -> nationality,
            'role' => $this->role,
            'Birth_Day' => $this->birth_day,
            'Name OF School ' => $this->school->name,
           // 'School of users' => SchoolResource::collection($this->school_id),

        ];
    }
}
