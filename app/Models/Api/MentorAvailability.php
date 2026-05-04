<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TimeZone;
use App\Models\Day;

class MentorAvailability extends Model
{
    use HasFactory;
    protected $table = 'mentor_availability';
    protected $fillable =[
        'zone_id',
        'day_id',
        'mentor_id',
        'available_date',
        'start_time',
        'end_time',
    ];

    public function zone()
    {
        return $this->belongsTo(TimeZone::class,'zone_id');
    }

    public function day()
    {
        return $this->belongsTo(Day::class,'day_id');
    }
}
