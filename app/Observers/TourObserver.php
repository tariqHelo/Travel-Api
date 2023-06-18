<?php

namespace App\Observers;

use App\Models\Tour;
use Illuminate\Support\Str;

class TourObserver
{
    public function creating(Tour $tour)
    {
        // $tour->slug = Str::slug($tour->title);
    }
}
