<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class EducationExperience extends Model
{
    use HasFactory;

    protected $guarded=[''];

    protected $primaryKey ='EducationExperienceID';


   

    public function degrees()
    {
        return $this->hasOne(Degree::class,'id', 'degree');
    }

    public function fieldOfStudy()
    {
        return $this->hasOne(FieldOfStudy::class,'id', 'fields_of_study');
    }

    public function schools()
    {
        return $this->hasOne(School::class,'id', 'school');
    }

}
