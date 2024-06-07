<?php

namespace App\Http\Resources;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use  App\Http\Resources\Addition as AdditionResource;

class Addition extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
           //'ID Addition' => $this->id ,
           'ID School Addition' => $this->school_id ,
           'ID OF students ' => $this->student_id,
           'information_request' => $this->information_request,
        ];
    }
}
