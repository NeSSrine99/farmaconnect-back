<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // GET /orders
    public function index()
    {
        return Order::with('items.product')->get();
    }

    // POST /orders
    public function store(Request $request)
    {
        $order = Order::create([
            'user_id' => $request->user_id,
            'status' => 'pending',
            'total_price' => 0
        ]);

        $total = 0;

        foreach ($request->items as $item) {
            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);

            $total += $item['price'] * $item['quantity'];
        }

        $order->update(['total_price' => $total]);

        return response()->json($order->load('items'), 201);
    }

    // UPDATE status (Admin / Pharmacist)
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'status' => $request->status // approved / rejected / prepared
        ]);

        return response()->json($order);
    }
}
