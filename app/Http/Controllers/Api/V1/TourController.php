<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTourRequest;
use App\Http\Requests\ToursListRequest;
use App\Http\Requests\UpdateTourRequest;
use App\Http\Resources\TourResource;
use App\Models\Tour;
use App\Models\Travel;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Travel $travel, ToursListRequest $request)
    {

        $tours = $travel->tours()
            ->when($request->priceForm, fn ($query) => $query->where('price', '>=', $request->priceFrom * 100))
            ->when($request->priceTo, fn ($query) => $query->where('price', '<=', $request->priceTo * 100))
            ->when($request->dateFrom, fn ($query) => $query->where('start_date', '>=', $request->dateFrom))
            ->when($request->dateTo, fn ($query) => $query->where('end_date', '<=', $request->dateTo))
            ->when($request->sortBy, fn ($query) => $query->orderBy($request->sortBy, $request->sortOrder))
            ->orderBy('start_date')
            ->paginate(15);

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
