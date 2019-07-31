<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories');
    }
}
