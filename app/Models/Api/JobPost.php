<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Countries;
use App\Models\Cities;
use App\Models\Language;
use App\Models\User;

class JobPost extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];


    public function applicants()
    {
        return $this->belongsToMany(User::class,'applied_jobs', 'post_id');
    }


    /**
     * Get all of the comments for the JobPost
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function companyInfo()
    {
        return $this->HasMany(JobPostCompanyInfo::class, 'post_id', 'id');
    }

    /**
     * Get the user that owns the JobPost
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */

    public function postDetails()
    {
        return $this->HasMany(JobPostDetail::class, 'post_id', 'id');
    }

    /**
     * Get all of the comments for the JobPost
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function JobPostAccountInfo()
    {
        return $this->hasMany(JobPostAccountInfo::class, 'post_id', 'id');
    }

    /**
     * Get the user that owns the JobPost
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Countries::class, 'country_id', 'id');
    }

    /**
     * Get the user that owns the JobPost
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(Cities::class, 'city_id', 'id');
    }

    /**
     * Get the user that owns the JobPost
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function company()
    {
        return $this->hasOne(JobPostCompanyInfo::class, 'post_id');
    }

    /**
     * Get the user that owns the JobPost
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function details()
    {
        return $this->hasOne(JobPostDetail::class, 'post_id');
    }

    /**
     * Get the user that owns the JobPost
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the user that owns the JobPost
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language()
    {
        return $this->belongsTo(Language::class, 'post_lang_id', 'id');
    }

    public function scopeRelations($query)
    {
        return $query->has('companyInfo')->has('postDetails')->with('company')->with('details')->with('country')->with('user')->with('language')->with('city');
    }


}
