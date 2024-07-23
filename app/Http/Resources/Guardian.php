<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use  App\Http\Resources\Guardian as GuardianResource;

class Guardian extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id of Guardians' => $this->id ,
            'student_id' => $this->student_id,
            'guardian_id' => $this->guardian_id,
        ];
    }
}
