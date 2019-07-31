<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Location;

class LocationController extends Controller
{
    public function index()
    {
        return view('locations');
    }
}