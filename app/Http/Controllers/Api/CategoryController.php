<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::with('parent')->get());
    }

    public function store(Request $request)
    {

        Category::create([
            'name'      => $request->input('name'),
            'parent_id' => $request->input('parent_id'),
        ]);
    }

    public function destroy(Category $category)
    {
        $category->delete();
    }
}
