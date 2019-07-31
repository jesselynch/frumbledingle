<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Location;

class ReportsController extends Controller
{
    public function index()
    {
        return view('reports');
    }
}