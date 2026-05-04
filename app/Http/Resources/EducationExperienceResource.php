<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EducationExperienceResource extends JsonResource
// class EducationExperienceResource extends ResourceCollection
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
            'id' => $this->EducationExperienceID,
            'AdviseeID' => $this->AdviseeID,
            'AdvisorID' => $this->AdvisorID,
            'Created_timestamp_EST' => Carbon::parse($this->Created_timestamp_EST)->format('Y-m-d'),
            'degree' => $this->degree,
            'fields_of_study' => json_decode($this->fields_of_study,true),
            'graduation_year' => $this->graduation_year?Carbon::parse($this->graduation_year)->format('Y-m-d'):null,
            'custom_graduation_year' => $this->graduation_year?date('m/y',strtotime($this->graduation_year)):null,
            'Modified_timestamp_EST' => Carbon::parse($this->Modified_timestamp_EST)->format('Y-m-d'),
            'recency' => $this->recency,
            'school' => $this->school,
            'UserID' => $this->UserID,
            'is_current' => $this->is_current,
            'start_date' => $this->start_date?Carbon::parse($this->start_date)->format('Y-m-d'):null,
            'ask_me_about' => $this->ask_me_about,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
