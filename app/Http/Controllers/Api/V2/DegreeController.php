<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\Helpers\ApiResponseTrait;
use App\Http\Resources\DegreeResource;

class DegreeController extends Controller
{
    use ApiResponseTrait;

    public function __invoke(Request $request)
    {
        $degrees=DB::table('degrees')->get();
        return $this->respondWithResource(new DegreeResource($degrees),'Degree Listing',200);
    }
}
