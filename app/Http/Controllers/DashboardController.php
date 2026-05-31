<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCategories = Category::count();
        $totalProducts = Product::count();
        $totalStock = Product::sum('stock');

        // Fetch recent products and categories for extra premium feel!
        $recentProducts = Product::with('category')->latest()->take(5)->get();

        return view('dashboard', compact('totalCategories', 'totalProducts', 'totalStock', 'recentProducts'));
    }
}
