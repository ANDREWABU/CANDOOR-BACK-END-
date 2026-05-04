<?php

namespace App\Models\Api;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppliedJob extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function post()
    {
        return $this->belongsTo(JobPost::class, 'post_id', 'id');
    }

}
