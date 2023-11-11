<?php
// app/Http/Controllers/CartController.php
// app/Http/Controllers/CartController.php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Country;
use App\Models\CartItem;
use App\Services\DiscountService;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::with('product')->get();
        $products = Product::all();
        
        return view('cart.index', ['cartItems' => $cartItems, 'products' => $products]);
    }
    public function addItem(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);
    
        $product = Product::find($productId);
    
        if ($product) {
            $cartItem = CartItem::where('product_id', $productId)->first();
    
            if ($cartItem) {
                // If the item already exists in the cart, update the quantity
                $cartItem->quantity += $quantity;
                $cartItem->save();
            } else {
                // If the item doesn't exist in the cart, create a new cart item
                $user = Auth::user();
    
                if ($user) { // Check if the user is authenticated
                    CartItem::create([
                        'product_id' => $productId,
                        'quantity' => $quantity,
                        'user_id' => $user->id, // Use the user's ID, not the entire user instance
                    ]);
    
                    return redirect('/cart')->with('success', 'Product added to the cart.');
                } else {
                    return redirect('/cart')->with('error', 'User not authenticated.');
                }
            }
        } else {
            return redirect('/cart')->with('error', 'Product not found.');
        }
    }  
    private $cart = [];
    private $discountService;

    public function __construct(DiscountService $discountService)
    {
        $this->middleware('auth'); // Requires authentication for all methods
        $this->discountService = $discountService;
    }

    public function calculateInvoice()
    {
        $cartItems = CartItem::with('product')->get();
        $subtotal = 0;
        $shipping = 0;
        $vat = 0;

        foreach ($cartItems as $cartItem) {
            $subtotal += $cartItem->product->price * $cartItem->quantity;
        }

        $vat = 0.14 * $subtotal; // 14% VAT

        // Apply discounts using DiscountService
        $subtotal -= $this->discountService->applyShoesDiscount($cartItems);
        $subtotal -= $this->discountService->applyTopsJacketDiscount($cartItems);
        $shipping -= $this->discountService->applyShippingDiscount($cartItems);

        // Calculate shipping fees
        $shipping = $this->calculateShippingFees($cartItems);

        $total = $subtotal + $vat + $shipping;

        $shoesDiscount = $this->discountService->applyShoesDiscount($cartItems);
        $jacketDiscount = $this->discountService->applyTopsJacketDiscount($cartItems);
        $shippingDiscount = $this->discountService->applyShippingDiscount($cartItems);

        return view('cart.invoice', compact('subtotal', 'shipping', 'vat', 'total', 'shoesDiscount', 'jacketDiscount', 'shippingDiscount'));
    }

    private function calculateShippingFees()
    {
        // Calculate shipping fees based on the country
        $shippingRate = 0;

        foreach ($this->cart as $product) {
            $shippingRate += $this->getShippingRate($product->shipped_from);
        }

        return $shippingRate;
    }

    public function removeItem($id)
    {
        $cartItem = CartItem::find($id);

        if ($cartItem) {
            $cartItem->delete();
            return redirect('/cart')->with('success', 'Product removed from the cart.');
        }

        return redirect('/cart')->with('error', 'Product not found in the cart.');
    }

}
