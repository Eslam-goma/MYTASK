<?php
// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $cartItems = CartItem::with('product')->where('user_id', $user->id)->get();

        return view('user.dashboard', ['user' => $user, 'cartItems' => $cartItems]);
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
