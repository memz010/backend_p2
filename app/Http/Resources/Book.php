<?php

namespace App\Http\Resources;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use  App\Http\Resources\Book as BookResource;

class Book extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id of Books' => $this->id ,
           'subject_id' => $this->subject_id ,
           'book_id ' => $this->book_id,
           'assosiation_level' => $this->assosiation_level,
        ];
    }
}
