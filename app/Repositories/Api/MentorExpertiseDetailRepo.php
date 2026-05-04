<?php

namespace App\Repositories\Api;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model
use App\Models\Api\MentorExpertiseDetail;

/**
 * Class MentorExpertiseDetailRepo.
 */
class MentorExpertiseDetailRepo extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return MentorExpertiseDetail::class;
    }
}
