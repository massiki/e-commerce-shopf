<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Merge session cart with user cart
            $this->mergeSessionCart();

            if (auth()->user()->isAdmin()) {
                return redirect()->intended(route('admin.dashboard'));
            }

            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        $this->mergeSessionCart();

        return redirect()->route('home')->with('success', 'Account created successfully!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Logged out successfully!');
    }

    private function mergeSessionCart()
    {
        $sessionCartId = session('cart_id');
        if ($sessionCartId) {
            $sessionCart = Cart::with('items')->find($sessionCartId);
            if ($sessionCart && $sessionCart->items->isNotEmpty()) {
                $userCart = Cart::firstOrCreate(['user_id' => auth()->id()]);

                foreach ($sessionCart->items as $item) {
                    $existingItem = $userCart->items()->where('product_id', $item->product_id)->first();
                    if ($existingItem) {
                        $existingItem->update(['quantity' => $existingItem->quantity + $item->quantity]);
                    } else {
                        $userCart->items()->create([
                            'product_id' => $item->product_id,
                            'quantity' => $item->quantity,
                        ]);
                    }
                }

                $sessionCart->items()->delete();
                $sessionCart->delete();
            }
            session()->forget('cart_id');
        }
    }
}
