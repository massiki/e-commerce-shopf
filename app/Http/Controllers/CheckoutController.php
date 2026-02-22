<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', auth()->id())->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $cart->load('items.product');

        return view('checkout.index', compact('cart'));
    }

    public function store(Request $request)
    {
        $cart = Cart::where('user_id', auth()->id())->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $cart->load('items.product');

        // Check stock availability
        foreach ($cart->items as $item) {
            if ($item->quantity > $item->product->stock) {
                return redirect()->back()->with('error', "Insufficient stock for {$item->product->name}.");
            }
        }

        // Create order
        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => $cart->total,
            'status' => 'pending',
        ]);

        // Create order items & reduce stock
        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);

            $item->product->decrement('stock', $item->quantity);
        }

        // Clear cart
        $cart->items()->delete();

        return redirect()->route('dashboard')->with('success', 'Order placed successfully! Order #' . $order->id);
    }
}
