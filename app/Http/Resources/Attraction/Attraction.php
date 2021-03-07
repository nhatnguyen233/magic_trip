<?php

namespace App\Http\Resources\Attraction;

use Illuminate\Http\Resources\Json\JsonResource;

class Attraction extends JsonResource
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
            'avatar' => $this->avatar_url,
            'thumbnail' => $this->thumbnail_url,
            'name' => $this->name,
            'title' => $this->title,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'images' => $this->images,
        ];
    }
}
