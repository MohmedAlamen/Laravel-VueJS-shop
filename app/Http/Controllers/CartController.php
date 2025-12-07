<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Display the cart page.
     */
    public function index()
    {
        return Inertia::render("Cart/Index", [
            "cartItems" => $this->cartService->getItems(),
            "cartTotal" => $this->cartService->getTotal(),
        ]);
    }

    /**
     * Add a product to the cart.
     */
    public function store(Request $request)
    {
        $request->validate([
            "product_id" => "required|exists:products,id",
            "quantity" => "nullable|integer|min:1",
        ]);

        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity ?? 1;

        $this->cartService->addProduct($product, $quantity);

        return back()->with("success", "Product added to cart!");
    }

    /**
     * Update the quantity of a product in the cart.
     */
    public function update(Request $request)
    {
        $request->validate([
            "product_id" => "required|exists:products,id",
            "quantity" => "required|integer|min:0",
        ]);

        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;

        $this->cartService->updateQuantity($product, $quantity);

        return back()->with("success", "Cart updated!");
    }

    /**
     * Remove a product from the cart.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            "product_id" => "required|exists:products,id",
        ]);

        $product = Product::findOrFail($request->product_id);

        $this->cartService->removeProduct($product);

        return back()->with("success", "Product removed from cart!");
    }
}
