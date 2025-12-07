<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CheckoutController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Display the checkout page.
     */
    public function index()
    {
        $cartItems = $this->cartService->getItems();
        $cartTotal = $this->cartService->getTotal();

        if ($cartItems->isEmpty()) {
            return redirect()->route("cart.index")->with("error", "Your cart is empty.");
        }

        return Inertia::render("Checkout/Index", [
            "cartItems" => $cartItems,
            "cartTotal" => $cartTotal,
            "user" => auth()->user() ? [
                "name" => auth()->user()->name,
                "email" => auth()->user()->email,
            ] : null,
        ]);
    }

    /**
     * Process the checkout and place the order.
     */
    public function store(Request $request)
    {
        $request->validate([
            "customer_name" => "required|string|max:255",
            "customer_email" => "required|email|max:255",
            "shipping_address" => "required|string",
            "payment_method" => "required|string", // Stub for payment method
        ]);

        $cartItems = $this->cartService->getItems();
        $cartTotal = $this->cartService->getTotal();

        if ($cartItems->isEmpty()) {
            return back()->withErrors(["checkout" => "Your cart is empty."]);
        }

        try {
            DB::beginTransaction();

            // 1. Create the Order
            $order = Order::create([
                "user_id" => auth()->id(),
                "customer_name" => $request->customer_name,
                "customer_email" => $request->customer_email,
                "shipping_address" => $request->shipping_address,
                "total_price" => $cartTotal,
                "status" => "pending", // Initial status
                "payment_method" => $request->payment_method,
                // "payment_intent_id" => $request->payment_intent_id, // For real payment integration
            ]);

            // 2. Add Order Items
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    "order_id" => $order->id,
                    "product_id" => $cartItem->product_id,
                    "quantity" => $cartItem->quantity,
                    "price" => $cartItem->product->price, // Price at time of purchase
                ]);
            }

            // 3. Clear the user's cart
            $this->cartService->clearCart();

            DB::commit();

            // 4. Redirect to an order confirmation page
            return redirect()->route("orders.show", $order->id)->with("success", "Order placed successfully!");

        } catch (\Exception $e) {
            DB::rollBack();
            // Log error
            return back()->withErrors(["checkout" => "An error occurred during checkout. Please try again."]);
        }
    }
}
