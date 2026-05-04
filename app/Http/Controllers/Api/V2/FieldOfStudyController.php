<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\Helpers\ApiResponseTrait;
use App\Http\Resources\FiledOfStudyResource;

class FieldOfStudyController extends Controller
{
    use ApiResponseTrait;

    public function __invoke(Request $request)
    {
        $filed_of_studies=DB::table('field_of_studies')->get();
        return $this->respondWithResource(new FiledOfStudyResource($filed_of_studies),'Filed of Studies Listing',200);
    }
}
