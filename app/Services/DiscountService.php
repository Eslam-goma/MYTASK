<?php
// app/Services/DiscountService.php
// app/Services/DiscountService.php

namespace App\Services;

use App\Models\CartItem;

class DiscountService
{
    public function applyShoesDiscount($cartItems)
    {
        // Apply 10% off for shoes
        $shoesDiscount = 0;

        foreach ($cartItems as $cartItem) {
            if ($cartItem->product->name === 'Shoes') {
                $shoesDiscount += 0.1 * $cartItem->product->price * $cartItem->quantity;
            }
        }

        return $shoesDiscount;
    }

    public function applyTopsJacketDiscount($cartItems)
    {
        // Buy any two tops and get any jacket half its price
        $topsCount = 0;
        $jacketDiscount = 0;

        foreach ($cartItems as $cartItem) {
            if ($cartItem->product->name === 'T-shirt' || $cartItem->product->name === 'Blouse') {
                $topsCount += $cartItem->quantity;
            } elseif ($cartItem->product->name === 'Jacket' && $topsCount >= 2) {
                $jacketDiscount = 0.5 * $cartItem->product->price * $cartItem->quantity;
                break;
            }
        }

        return $jacketDiscount;
    }

    public function applyShippingDiscount($cartItems)
    {
        // Buy any two items or more and get a maximum of $10 off shipping fees
        $itemsCount = count($cartItems);
        $shippingDiscount = min($itemsCount * 2, 10);

        return $shippingDiscount;
    }
}

