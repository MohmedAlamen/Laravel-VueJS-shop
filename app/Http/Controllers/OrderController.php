<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    /**
     * Display the user's orders.
     */
    public function index()
    {
        $orders = Order::where("user_id", auth()->id())
            ->orderBy("created_at", "desc")
            ->paginate(10);

        return Inertia::render("Orders/Index", [
            "orders" => $orders,
        ]);
    }

    /**
     * Display a specific order.
     */
    public function show(Order $order)
    {
        // Ensure the user can only view their own orders
        if ($order->user_id !== auth()->id()) {
            abort(403, "Unauthorized action.");
        }

        return Inertia::render("Orders/Show", [
            "order" => $order->load("items.product"),
        ]);
    }
}
