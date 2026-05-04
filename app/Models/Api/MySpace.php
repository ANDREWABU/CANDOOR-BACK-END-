<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CareerSpace;

class MySpace extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'career_space_id'
    ];

    public function spaces()
    {
        return $this->belongsTo(CareerSpace::class,'career_space_id');
    }
}
