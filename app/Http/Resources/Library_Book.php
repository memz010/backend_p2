<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use  App\Http\Resources\Library_Book as Library_BookResource;

class Library_Book extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id of labrary' =>$this->id,
            'library_id' => $this->library_id,
            'name' => $this->name,
            'description' => $this->description,
            'author' => $this->author,
            'type' => $this-> type,
            'pages '=> $this-> pages,
        ];
    }
}
