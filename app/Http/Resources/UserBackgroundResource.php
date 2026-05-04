<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserBackgroundResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'country' => $this->country,
            'city' => $this->city,
            'state' => $this->state,
            'time_zone' => $this->time_zone,
            'gender' => $this->gender,
            'race' => json_decode($this->city,true),
            'extra_info' => $this->extra_info,
            'belongs_to' => json_decode($this->belongs_to,true),
        ];
    }
}
