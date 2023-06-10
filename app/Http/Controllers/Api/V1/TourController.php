<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StoreTourRequest;
use App\Http\Requests\UpdateTourRequest;
use App\Models\Tour;
use App\Models\Travel;
use App\Http\Controllers\Controller;
use App\Http\Resources\TourResource;
class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Travel $travel)
    {
        $tours =  $travel->tours()->orderBy('start_date')->paginate(15);

        return TourResource::collection($tours);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTourRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Tour $tour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tour $tour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTourRequest $request, Tour $tour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tour $tour)
    {
        //
    }
}
