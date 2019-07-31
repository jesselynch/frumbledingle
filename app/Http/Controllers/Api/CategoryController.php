<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Category;
use Illuminate\Foundation\Validation\ValidatesRequests;

class CategoryController extends Controller
{
    use ValidatesRequests;
    
    public function index()
    {
        return response()->json(Category::with('parent')->get());
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required',
            'parent_id' => ''
        ]);

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
