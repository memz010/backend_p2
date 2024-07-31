<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use  App\Http\Resources\Subject as SubjectResource;

class Subject extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_stage of subject' => $this->id_stage,
            'name of subject' => $this->name,
            'semester' => $this->semester,
            'lectuer_per_week' => $this->lectuer_per_week,
        ];
    }
}
