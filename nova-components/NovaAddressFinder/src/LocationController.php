<?php

namespace Brunocfalcao\NovaAddressFinder;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LocationController extends Controller
{
    public function updateLocation(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'resourceId' => 'required',
            'resourceName' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'locality' => 'required',
            'country' => 'required',
        ]);

        // Update location in your Eloquent model
        // Implement the update logic here

        return response()->json(['message' => 'Location updated successfully']);
    }
}
