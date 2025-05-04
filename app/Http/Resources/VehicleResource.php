<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'vin' => $this->vin,
            'year' => $this->year,
            'color' => $this->color,
            'mileage' => $this->mileage,
            'status' => $this->status,
            'location' => $this->when($this->location, [
                'lat' => $this->location->getLat(),
                'lng' => $this->location->getLng()
            ]),
            'model' => [
                'id' => $this->model->id,
                'name' => $this->model->name,
                'type' => $this->model->type,
                'brand' => [
                    'id' => $this->model->brand->id,
                    'name' => $this->model->brand->name,
                    'manufacturer' => [
                        'id' => $this->model->brand->manufacturer->id,
                        'name' => $this->model->brand->manufacturer->name,
                        'country' => $this->model->brand->manufacturer->country
                    ]
                ]
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
