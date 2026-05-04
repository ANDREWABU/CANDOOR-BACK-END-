<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserCarrerGoalResource extends JsonResource
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
            'AdviseeID' => $this->AdviseeID,
            'UserID' => $this->UserID,
            'next_carrer_goals' => (empty($this->current_career_goals)) ? $this->initial_career_goals : $this->current_career_goals,
            'employment_opportunities' => $this->job_search_status,
            'is_prescrean_program' => $this->prescreening_program_opt_in,
            'dream_roles' => json_decode($this->dream_roles,true),
            'dream_industries' => json_decode($this->dream_industries,true),
            'dream_companies' => json_decode($this->dream_companies,true),
            'excited_topics' => json_decode($this->services_requested,true),
            'why_joined' => $this->why_joined,
            'job_locations' => $this->dream_locations?$this->dream_locations:'',
            'dream_companies_other' => $this->dream_companies_other?$this->dream_companies_other:'',
        ];
    }
}
