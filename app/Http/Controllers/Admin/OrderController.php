<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * 📋 List all orders (FAST & OPTIMIZED)
     */
    public function index()
    {
        $orders = Order::with(['user', 'items.product']) // ✅ FIX
            ->latest()
            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * ⚡ AJAX: Load order items
     */
    public function items($id)
    {
        $order = Order::with(['items.product'])
            ->findOrFail($id);

        return response()->json($order);
    }

    /**
     * 📄 Show single order (full details)
     */
    public function show($id)
    {
        $order = Order::with(['user', 'items.product'])
            ->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * 🔄 Update order status (SAFE)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,rejected,delivered'
        ]);

        $order = Order::findOrFail($id);

        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Order status updated successfully');
    }
}
