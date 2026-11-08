<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PriceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'service_group' => $this->service->name,
            'name' => $this->name,
            'description' => $this->description,
            'benefits' => $this->benefits,
            'price' => $this->price,
            'duration' => $this->duration,
            'sort_order' => $this->sort_order,
        ];
    }
}
