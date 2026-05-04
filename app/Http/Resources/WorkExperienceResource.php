<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkExperienceResource extends JsonResource
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
            "id"=> $this->WorkExperienceID,
            "AdviseeID"=> $this->AdviseeID,
            "AdvisorID"=> $this->AdvisorID,
            "company"=> $this->company,
            "Created_timestamp_EST"=> Carbon::parse($this->Created_timestamp_EST)->format('Y-m-d'),
            "employment_type"=> $this->employment_type,
            "custom_start_date"=>Carbon::parse($this->start_date)->format('m/y'),
            "custom_end_date"=>Carbon::parse($this->end_date)->format('m/y'),
            "start_date"=>Carbon::parse($this->start_date)->format('Y-m-d'),
            "end_date"=>Carbon::parse($this->end_date)->format('Y-m-d'),
            "industry"=> $this->industry,
            "is_current"=> $this->is_current,
            "Modified_timestamp_EST"=> Carbon::parse($this->Created_timestamp_EST)->format('Y-m-d'),
            "recency"=> $this->recency,
            "role"=> $this->role,
            "title"=> $this->title,
            "UserID"=> $this->UserID,
            "ask_me_about"=> $this->ask_me_about,
            'employment_type_other' => $this->employment_type_other?$this->employment_type_other:'',
            "created_at"=> $this->created_at,
            "updated_at"=> $this->updated_at
        ];
    }
}
