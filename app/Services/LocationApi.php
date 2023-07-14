<?php

namespace App\Services;

use App\Models\Location;

class LocationApi
{
    protected $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = config('location.api_key');
    }

    /**
     * getLocation function
     */
    public function getLocation($searchLatitude, $searchLongitude, $radius)
    {
        $data = Location::select('id', 'name', 'latitude', 'longitude')
            ->selectRaw("
                (6371 *
                    acos(
                        cos(radians($searchLatitude))
                        * cos(radians(latitude))
                        * cos(
                            radians(longitude) - radians($searchLongitude)
                        ) + sin(radians($searchLatitude))
                        * sin(radians(latitude))
                    )
                ) AS distance") // 6371km total Earth radius
            ->havingRaw("distance <= $radius")
            ->orderBy('distance')
            ->get();

        return $data;
    }
}