<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Countries;
use App\Models\Cities;

class MentorPersonalInformation extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function country()
    {
        return $this->belongsTo(Countries::class,'country');
    }

    public function city()
    {
        return $this->belongsTo(Cities::class,'city');
    }


}
