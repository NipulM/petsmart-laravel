<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Subscription;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $newProducts = Product::new()->get();
        $subscriptions = Subscription::all();
        return view('dashboard', compact('newProducts', 'subscriptions'));
    }
}
