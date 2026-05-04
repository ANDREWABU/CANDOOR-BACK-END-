<?php

namespace App\Repositories\Api;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model
use App\Models\Api\PersonalInformation;


/**
 * Class MentorPersonalInfoRepo.
 */
class MentorPersonalInfoRepo extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return PersonalInformation::class;
    }

    public function insertData(array $var, int $id)
    {
        $data = $this->model->updateOrCreate([
            'user_id' => $id,
            'email' => $var['email']], [
            'country' => $var['country'],
            'city' => $var['city'],
            'description' => $var['description'],
        ]);
        return $data;
    }
}
