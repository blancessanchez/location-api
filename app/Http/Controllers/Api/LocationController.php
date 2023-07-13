<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationSearchRequest;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Search location logic
     */
    public function search(LocationSearchRequest $request)
    {
        $searchLatitude = $request->query('latitude');
        $searchLongitude = $request->query('longitude');
        $radius = $request->query('radius');

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

        return response()->json($data);
    }
}
