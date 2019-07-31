<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Category;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Validation\ValidationException;
use Error;

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

    public function destroy(Request $request)
    {
        $category = Category::find($request->route('category'));
        if ($category->items()->exists()) {
            return response(['items' => ['Unable to delete, category has items']], 422);
        } elseif (Category::where('parent_id', '=', $category->id)->exists()) {
            return response(['items' => ['Unable to delete, category is the parent of sub-categories']], 422);
        }
        $category->delete();
    }
}
