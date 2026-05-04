<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Countries;
use App\Models\Cities;

class PersonalInformation extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function country()
    {
        return $this->belongsTo(Countries::class,'country');
    }

    public function city()
    {
        return $this->belongsTo(Cities::class,'city');
    }

    /**
     * Get the user that owns the PersonalInformation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function skills()
    {
        return $this->hasMany(Skill::class, 'mentee_id', 'mentee_id');
    }

    /**
     * Get the user that owns the PersonalInformation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function education()
    {
        return $this->hasMany(EducationDetail::class, 'mentee_id', 'mentee_id');
    }

    /**
     * Get the user that owns the PersonalInformation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function experience()
    {
        return $this->hasMany(WorkExperience::class, 'mentee_id', 'mentee_id')->with('country')->with('city'    );
    }

    // public function scopeWorkExp($query)
    // {

    // }
}
