<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Category;
use App\Models\Location;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $price = $request->input('price');

        $data = DB::table('items AS i')
            ->join('locations AS l', 'l.id', 'i.location_id')
            ->join('categories AS c', 'c.id', 'i.category_id')
            ->leftJoin('categories AS c2', 'c.parent_id', 'c2.id')
            ->selectRaw('l.name as location, c.name as category, c2.name as parent_category, count(i.id) as item_count')
            ->whereNull('i.deleted_at')
            ->whereNull('l.deleted_at')
            ->whereNull('c.deleted_at')
            ->whereNull('c2.deleted_at')
            ->groupBy('l.name', 'c.name', 'c2.name', 'i.category_id');
        
        if (!empty($price)) {
            $data = $data->where('i.price', '>=', $price);
        }
        return response()->json($data->get());
    }
}
