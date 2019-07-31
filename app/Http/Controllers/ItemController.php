<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        return view('items');
    }
}
