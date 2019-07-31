<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;

class LocationController extends Controller
{
    use ValidatesRequests;

    public function index()
    {
        return response()->json(Location::get());
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        Location::create(['name' => $request->input('name')]);
    }

    public function destroy(Location $location)
    {
        $location->delete();
    }
}