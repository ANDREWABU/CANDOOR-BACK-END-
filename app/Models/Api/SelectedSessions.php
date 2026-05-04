<?php

namespace App\Models\Api;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectedSessions extends Model
{
    use HasFactory;
    protected $fillable = ['session_id','mentee_id', 'mentor_id','start_time','end_time','booked_date', 'status', 'type'];

    public function user(){

        return $this->belongsTo(User::class, 'mentor_id','id');
    }

    public function expertise_details_session(){

        return $this->belongsTo(MentorExpertiseDetail::class, 'session_id','id');
    }

}
