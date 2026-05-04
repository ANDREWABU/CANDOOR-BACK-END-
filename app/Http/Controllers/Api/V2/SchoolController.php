<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\Helpers\ApiResponseTrait;
use App\Http\Resources\SchoolResource;

class SchoolController extends Controller
{
    use ApiResponseTrait;

    public function __invoke(Request $request)
    {
        $schools=DB::table('schools')->get();
        return $this->respondWithResource(new SchoolResource($schools),'Schools Listing',200);
    }
}
