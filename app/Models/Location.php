<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'deleted_at',
    ];

    /**
     * Search function
     *
     * @return Collection
     */
    public static function search($searchLatitude, $searchLongitude, $radius)
    {
        $query = Location::select('id', 'name', 'latitude', 'longitude')
            ->selectRaw("(6371 * acos(cos(radians($searchLatitude)) * cos(radians(latitude)) * cos(radians(longitude) - radians($searchLongitude)) + sin(radians($searchLatitude)) * sin(radians(latitude)))) AS distance")
            ->havingRaw("distance <= $radius")
            ->orderBy('distance')
            ->get();

        return $query;
    }
}
