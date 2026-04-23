<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Prescription;
use App\Models\Product;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function index()
    {
        $prescriptions = Prescription::with('user')->latest()->get();
        return view('admin.prescriptions.index', compact('prescriptions'));
    }

    // ✅ AJAX UPDATE STATUS
    public function updateStatus(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required|in:pending,accepted,rejected'
            ]);

            $prescription = Prescription::findOrFail($id);

            $reviewedBy = auth()->check() ? auth()->id() : 1;

            $prescription->update([
                'status' => $request->status,
                'reviewed_by' => $reviewedBy
            ]);

            return response()->json([
                'success' => true,
                'status' => $prescription->status
            ]);
        } catch (\Exception $e) {
            \Log::error('Prescription Status Update Error: ' . $e->getMessage());

            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ✅ COUNT FOR NOTIFICATION
    public function count()
    {
        return response()->json([
            'count' => Prescription::count()
        ]);
    }

    // ✅ CREATE ORDER PAGE
    public function createOrder($id)
    {
        $prescription = Prescription::with('user')->findOrFail($id);
        $products = Product::all();

        return view('admin.prescriptions.create-order', compact('prescription', 'products'));
    }

    // ✅ STORE ORDER
    public function storeOrder(Request $request, $id)
    {
        $prescription = Prescription::findOrFail($id);

        $order = Order::create([
            'user_id' => $prescription->user_id,
            'status' => 'pending',
            'total_price' => 0,
        ]);

        $total = 0;

        foreach ($request->products as $p) {
            if (!empty($p['product_id'])) {

                $product = Product::find($p['product_id']);
                $qty = $p['quantity'];

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $qty,
                    'price' => $product->price,
                ]);

                $total += $product->price * $qty;
            }
        }

        $order->update(['total_price' => $total]);

        return redirect()->route('admin.orders.show', $order->id)
            ->with('success', 'Order created successfully');
    }
}
