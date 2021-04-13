<?php

namespace App\Http\Resources\Schedule;

use Illuminate\Http\Resources\Json\JsonResource;

class Schedule extends JsonResource
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
            'tour_id' => $this->tour_id,
            'departure_time' => $this->departure_time,
            'number_max_slots' => $this->number_max_slots,
        ];
    }
}
