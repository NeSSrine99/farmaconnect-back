<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Prescription;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index', [
            'products' => Product::count(),
            'orders' => Order::count(),
            'users' => User::count(),
            'pendingOrders' => Order::where('status', 'pending')->count(),
            'prescriptions' => Prescription::count(),
        ]);
    }
}
