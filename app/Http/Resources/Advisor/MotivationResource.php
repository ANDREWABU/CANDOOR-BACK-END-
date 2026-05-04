<?php

namespace App\Http\Resources\Advisor;

use Illuminate\Http\Resources\Json\JsonResource;

class MotivationResource extends JsonResource
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
            'AdvisorID' => $this->AdvisorID,
            'UserID' => $this->UserID,
            'prior_experience' => $this->prior_experience,
            'is_prescrean_program' => $this->prescreening_program_opt_in,
            'why_joined' => $this->joining_reason,
        ];
    }
}
