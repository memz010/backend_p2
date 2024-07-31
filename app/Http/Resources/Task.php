<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use  App\Http\Resources\Task as TaskResource;

class Task extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'subject_id of taske' => $this->subject_id,
            'title' => $this->title,
            'uploaded_date' => $this->uploaded_date,
            'deadline' => $this->deadline,
            'start_of_submissions_date' => $this->start_of_submissions_date,
            'description' => $this->description,
        ];

    }
}
