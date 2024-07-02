<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use  App\Http\Resources\Certificate as CertificateResource;

class Certificate extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'file' => $this->file,
            'school_id' => $this->school_id,
            'user_id' => $this->user_id,
        ] ;
    }
}
