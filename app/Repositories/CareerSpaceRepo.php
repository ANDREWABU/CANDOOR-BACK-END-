<?php

namespace App\Repositories;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model
use App\Models\CareerSpace;

/**
 * Class CareerSpaceRepo.
 */
class CareerSpaceRepo extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return CareerSpace::class;
    }

    public function editForm(array $var)
    {
        # code...
    }
}
