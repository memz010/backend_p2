<?php

namespace App\Http\Resources;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use  App\Http\Resources\Librarie as LibrarieResource;

class Librarie extends JsonResource
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
            'id of labrary' => $this->id ,
            'labrary of school' => $this->school_id ,
            'description of labrary' => $this->description,
            'type' => $this->type,
        ];
    }
}
