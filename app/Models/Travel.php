<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
class Travel extends Model
{
    use HasFactory, HasUlids;

    protected $table='travels';


    protected $fillable=[
        'title',
        'is_published',
        'slug', // hello-world -> hello-world-1
        'description',
        'number_of_days'
    ];


    public function tours(): HasMany
    {
        return $this->hasMany(Tour::class);
    }


    public function numberOfNights(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['number_of_days'] - 1
        );
    }
}
