<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Item;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ItemController extends Controller
{
    use ValidatesRequests;
    
    public function index()
    {
        return response()->json(Item::with('location')->with('category')->get());
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required',
            'category' => 'required',
            'location' => 'required',
            'price'    => 'required',
        ]);

        Item::create([
            'name'          => $request->input('name'),
            'category_id'   => $request->input('category'),
            'location_id'   => $request->input('location'),
            'price'         => $request->input('price'),
        ]);
    }

    public function destroy(Item $item)
    {
        $item->delete();
    }
}
