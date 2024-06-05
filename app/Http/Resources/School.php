<?php

namespace App\Http\Resources;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use  App\Http\Resources\School as SchoolResource;

class School extends JsonResource
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
        'Name of School' => $this->name,
        'type of School' => $this->type,
        'Age of Stage' => $this->age_stage,
        'Subscription Price in School' => $this->Subscription_price,
        'Address of School' => $this->address,
        ] ;
    }
}
