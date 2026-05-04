<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPostCompanyInfo extends Model
{
    use HasFactory;
    protected $table ="job_post_company_info";
    protected $fillable = [
        'user_id',
        'post_id',
        'company_size',
        'hear_about_us_id',
        'name',
        'company_name',
        'phone_no',
    ];

}
