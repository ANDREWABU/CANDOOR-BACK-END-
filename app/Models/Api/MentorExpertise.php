<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorExpertise extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function expertise_details()
    {
        return $this->hasMany(MentorExpertiseDetail::class,'mentor_expertise_id');
    }
}
