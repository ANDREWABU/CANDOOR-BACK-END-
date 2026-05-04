<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExperience extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'experience_id'
    ];
}
