<?php

namespace App\Http\Resources;

use App\Booking;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Booking $this */
        return [
            'id' => $this->id,
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
            'rooms' => RoomResource::collection($this->whenLoaded('rooms'))
        ];
    }
}
