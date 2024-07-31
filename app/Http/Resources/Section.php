<?php

namespace App\Http\Resources;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use  App\Http\Resources\Section as SectionResource;

class Section extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        'id of section'  => $this->id,
        'student_id'  => $this->student_id,
         'stage_id'  => $this->stage_id,
         'count_of_student'  => $this->count_of_student,
         'number_of_section' => $this->number_of_section,
        ];
    }
}
