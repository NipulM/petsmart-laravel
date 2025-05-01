<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display the search page with categories
     */
    public function index()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('search.index', compact('categories', 'products'));
    }

    /**
     * Get all products
     */
    public function getAllProducts()
    {
        $products = Product::with('category')->get();
        return response()->json([
            'status' => 'success',
            'data' => $products
        ]);
    }

    /**
     * Get all categories
     */
    public function getAllCategories()
    {
        $categories = Category::all();
        return response()->json([
            'status' => 'success',
            'data' => $categories
        ]);
    }

    /**
     * Filter products by category and price range
     */
    public function filterProducts(Request $request)
    {
        $category = $request->query('category');
        $minPrice = $request->query('minPrice');
        $maxPrice = $request->query('maxPrice');

        $query = Product::query();
        $products = $query->filter($category, $minPrice, $maxPrice)->get();
        $categories = Category::all();

        if ($request->ajax()) {
            return view('search.product-grid', compact('products'))->render();
        }

        return view('search.index', compact('products', 'categories'));
    }
}
