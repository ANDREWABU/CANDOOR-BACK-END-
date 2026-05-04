<?php

namespace App\Models;

use App\Models\Api\EducationDetail;
use App\Models\Api\JobPost;
use App\Models\Api\MentorAvailability;
use App\Models\Api\MentorExpertise;
use App\Models\Api\MentorPersonalInformation;
use App\Models\Api\MySpace;
use App\Models\Api\PersonalInformation;
use App\Models\Api\SelectedSessions;
use App\Models\Api\Skill;
use App\Models\Api\UserExperience;
use App\Models\Api\WorkExperience;
use App\Models\Api\UserDetail;
use App\Models\TimeZone;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_role_id',
        'firstname',
        'lastname',
        'email',
        'password',
        'email_token',
        'email_verified',
        // 'google_id',
        'AdvisorID',
        'AdviseeID',
        'linkedin_id',
        'status',
    ];

    // Chnage Primary Key
    // protected $primaryKey = 'USERID';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }





    public function jobPost(){

        return $this->belongsToMany(JobPost::class,'applied_jobs','user_id');
    }

    public function careerSpaces(){
        return $this->belongsToMany(CareerSpace::class,'my_spaces','user_id');
    }

    //
    public function experience()
    {
        return $this->hasManyThrough(Experience::class, UserExperience::class, 'user_id', 'id', 'id', 'experience_id');
    }

    public function spaces()
    {
        return $this->hasManyThrough(CareerSpace::class, MySpace::class, 'user_id', 'id', 'id', 'career_space_id');
    }

    public function assignRole($roles, string $guard = null)
    {
        $roles = \is_string($roles) ? [$roles] : $roles;
        $guard = $guard ?: $this->getDefaultGuardName();

        $roles = collect($roles)
            ->flatten()
            ->map(function ($role) use ($guard) {
                return $this->getStoredRole($role, $guard);
            })
            ->each(function ($role) {
                $this->ensureModelSharesGuard($role);
            })
            ->all();

        $this->roles()->saveMany($roles);

        $this->forgetCachedPermissions();

        return $this;
    }

    /**
     * Get the user that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function personalInfo()
    {
        return $this->belongsTo(PersonalInformation::class, 'id', 'user_id')->with('city')->with('country');
    }

    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function skills()
    {
        return $this->hasMany(Skill::class, 'mentee_id', 'id');
    }

    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function workExp()
    {
        return $this->hasMany(WorkExperience::class, 'mentee_id', 'id');
    }

    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function education()
    {
        return $this->hasMany(EducationDetail::class, 'mentee_id', 'id');
    }

    /**
     * Get the userDetails that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function zone()
    {
        return $this->belongsTo(TimeZone::class, 'id', 'user_id');
    }
    public function scopeMenteeInfo($query)
    {
        return $query->with('personalInfo')->with('skills')->with('workExp')->with('education')->with('zone');
    }


//    mentor functions

   public function mentorPersonalInfo(){

       return
           $this->belongsTo(MentorPersonalInformation::class,'id','mentor_id')
           ->with('city')
           ->with('country');
   }

    public function scopeMentorInfo($query){

        return $query->with('mentorPersonalInfo');
    }

    public function MentorPersonalInformation(){

        return
            $this->belongsTo(PersonalInformation::class,'id','user_id')
                ->with('city')
                ->with('country')
            ;
    }
    public function scopeMentorInformation($query){

        return $query->with('MentorPersonalInformation');
    }

    public function mentorExpertise(){

        return $this->hasMany(MentorExpertise::class,'mentor_id', 'id');
    }
    public function mentorAvailability(){

        return $this->hasMany(MentorAvailability::class,'mentor_id', 'id');
    }


    // selected sessions

    public function selectedSessions(){

        return $this->hasMany(SelectedSessions::class,'mentor_id','id');

    }

}
