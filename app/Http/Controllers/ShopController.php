<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        $query = Product::query();

        if (request('search')) {
            $query->search(request('search'));
        }

        if (request('category')) {
            $query->category(request('category'));
        }

        $sort = request('sort', 'latest');
        $query = match($sort) {
            'price_low' => $query->orderBy('price', 'asc'),
            'price_high' => $query->orderBy('price', 'desc'),
            'name' => $query->orderBy('name', 'asc'),
            default => $query->latest(),
        };

        $products = $query->paginate(12)->appends(request()->query());
        $categories = Product::select('category')->distinct()->pluck('category');

        return view('shop.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        $relatedProducts = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('shop.show', compact('product', 'relatedProducts'));
    }
}
