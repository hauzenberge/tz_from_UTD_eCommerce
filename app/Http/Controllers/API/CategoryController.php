<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query()->select('id', 'name');

        if ($request->has('name')) {
            $name = $request->input('name');
            $query->where('name', 'like', '%' . $name . '%');
        }

        $perPage = $request->input('per_page', 10);       
        $page = $request->input('page', 1);
      
        $products = $query->paginate($perPage, ['*'], 'page', $page);
 
        return response()->json($products);
    }
}
