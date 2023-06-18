<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TravelRequest;
use App\Http\Resources\TravelResource;
use App\Models\Travel;

class TravelController extends Controller
{
    //invokable function for index

    public function __invoke()
    {
        return TravelResource::collection(Travel::all());
    }

    public function store(TravelRequest $request)
    {
        $travel = Travel::create($request->validated());

        return response()->json([
            'message' => 'Travel created successfully',
            'data' => new TravelResource($travel),
        ], 201);
    }

    public function show(Travel $travel)
    {
        return new TravelResource($travel);
    }

    //update function for update
    public function update(TravelRequest $request, Travel $travel)
    {
        $travel->update($request->validated());

        return response()->json([
            'message' => 'Travel updated successfully',
            'data' => new TravelResource($travel),
        ], 200);
    }
}
