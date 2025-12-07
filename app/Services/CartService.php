<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartService
{
    /**
     * Get the current user's or session's cart.
     */
    public function getCart(): Cart
    {
        if (Auth::check()) {
            // Get cart by user ID, or create one if it doesn't exist
            return Cart::firstOrCreate(['user_id' => Auth::id()]);
        } else {
            // Get cart by session ID, or create one if it doesn't exist
            $sessionId = Session::getId();
            return Cart::firstOrCreate(['session_id' => $sessionId]);
        }
    }

    /**
     * Add a product to the cart.
     */
    public function addProduct(Product $product, int $quantity = 1): void
    {
        $cart = $this->getCart();

        $cartItem = $cart->items()->where('product_id', $product->id)->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }
    }

    /**
     * Remove a product from the cart.
     */
    public function removeProduct(Product $product): void
    {
        $cart = $this->getCart();
        $cart->items()->where('product_id', $product->id)->delete();
    }

    /**
     * Update the quantity of a product in the cart.
     */
    public function updateQuantity(Product $product, int $quantity): void
    {
        $cart = $this->getCart();
        $cartItem = $cart->items()->where('product_id', $product->id)->first();

        if ($cartItem) {
            if ($quantity > 0) {
                $cartItem->quantity = $quantity;
                $cartItem->save();
            } else {
                $cartItem->delete();
            }
        }
    }

    /**
     * Clear the cart.
     */
    public function clearCart(): void
    {
        $cart = $this->getCart();
        $cart->items()->delete();
    }

    /**
     * Get the total price of the cart.
     */
    public function getTotal(): float
    {
        $cart = $this->getCart();
        return $cart->items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    }

    /**
     * Get the cart items with product details.
     */
    public function getItems()
    {
        return $this->getCart()->items()->with('product')->get();
    }
}
