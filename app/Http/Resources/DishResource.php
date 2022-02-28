<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DishResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'image' => $this->image,
            'user_id' => $this->user_id,
            'description' => $this->description,
            'ingredients' => $this->ingredients,
            'price' => $this->price,
            'visibility' => $this->visibility,
        ];
    }
}
