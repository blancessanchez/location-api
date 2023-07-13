<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Http\Requests\LocationSearchRequest;

class LocationController extends Controller
{
    /**
     * Search location logic
     */
    public function search(LocationSearchRequest $request)
    {
        $latitude = $request->query('latitude');
        $longitude = $request->query('longitude');
        $radius = $request->query('radius');

        $data = Location::search($latitude, $longitude, $radius)->all();

        return response()->json($data);
    }
}
