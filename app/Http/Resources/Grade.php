<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use  App\Http\Resources\Grade as GradeResource;

class Grade extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
        [
            'student_id' => $this->student_id,
            'exam_id' => $this->exam_id,
            'grade' => $this->grade,
        ] ;
    }
}
