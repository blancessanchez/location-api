<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationSearchRequest;
use App\Models\Location;
use App\Services\LocationApi;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * $locationApi variable
     */
    protected $locationApi;

    /**
     * __construct function
     */
    public function __construct(LocationApi $locationApi)
    {
        $this->locationApi = $locationApi;
    }

    /**
     * Search location logic
     */
    public function search(LocationSearchRequest $request)
    {
        $searchLatitude = $request->query('latitude');
        $searchLongitude = $request->query('longitude');
        $radius = $request->query('radius');

        $data = $this->locationApi->getLocation($searchLatitude, $searchLongitude, $radius);

        return response()->json($data);
    }
}
