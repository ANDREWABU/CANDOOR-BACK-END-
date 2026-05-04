<?php

namespace App\Repositories\Api;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Models\User;
//use Your Model

/**
 * Class ApiUserRepo.
 */
class ApiUserRepo extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return User::class;
    }
}
