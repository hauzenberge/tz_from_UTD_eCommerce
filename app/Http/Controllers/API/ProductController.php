<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->select('id', 'title', 'price', 'description', 'category_id', 'image', 'rating')
            ->with(['category' => function ($query) {
                $query->select('id', 'name');
            }]);

        // Фільтр за ім'ям (реєстронезалежний)
        if ($request->has('category_id')) {
            $category_id = intval($request->input('category_id'));
            $query->where('category_id', $category_id);
        }

        if ($request->has('title')) {
            $title = $request->input('title');
            $query->where('title', 'like', '%' . $title . '%');
        }

        // Пагінація
        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);
        $products = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json($products);
    }
}
