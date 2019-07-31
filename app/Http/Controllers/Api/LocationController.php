<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        return response()->json(Location::get());
    }

    public function store(Request $request)
    {
        Location::create(['name' => $request->input('name')]);
    }

    public function destroy(Location $location)
    {
        $location->delete();
    }
}