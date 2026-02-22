<?php

namespace App\Http\Controllers;

use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('items.product')
            ->latest()
            ->paginate(10);

        return view('dashboard', compact('orders'));
    }
}
