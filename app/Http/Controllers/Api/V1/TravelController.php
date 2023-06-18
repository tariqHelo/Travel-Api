<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TravelResource;
use App\Models\Travel;

class TravelController extends Controller
{
    public function index()
    {
        // $travels = Travel::where('is_published', true)->get();

        $travels = Travel::where('is_published', true)->paginate(15);

        return TravelResource::collection($travels);
    }
}
