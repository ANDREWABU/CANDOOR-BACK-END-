<?php

namespace App\Repositories\Api;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model
use App\Models\Api\MentorExpertise;
use App\Models\Api\MentorExpertiseDetail;

/**
 * Class MentorExpertiseRepo.
 */
class MentorExpertiseRepo extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return MentorExpertise::class;
    }

    public function storeExpertiseDetails(array $var)
    {
        // dd($var);
        $user_id = Auth('api')->id();
        $expertise = MentorExpertise::updateOrCreate([
            'mentor_id' => $user_id], [
            'expertise' => $var['expertise']
        ]);
        MentorExpertiseDetail::where('mentor_expertise_id',$expertise->id)->delete();
        if(!empty($var['workExp'])){
            foreach($var['workExp'] as $val){
                MentorExpertiseDetail::insert([
                    'session_title' => $val['session_title'],
                    'session_type' => $val['session_type'],
                    'session_price' => $val['session_price'],
                    'session_duration' => $val['session_duration'],
                    'mentor_expertise_id' => $expertise->id
                ]);
            }
        }

        return MentorExpertise::where('mentor_id', $user_id)->with('expertise_details')->get();
    }
}
