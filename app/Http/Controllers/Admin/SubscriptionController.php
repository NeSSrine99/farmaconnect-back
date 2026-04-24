<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    // 📋 LIST
    public function index()
    {
        $subscriptions = Subscription::with(['user', 'product'])
            ->latest()
            ->paginate(10);

        return view('admin.subscriptions.index', compact('subscriptions'));
    }

    // 👁️ SHOW
    public function show($id)
    {
        $subscription = Subscription::with(['user', 'product'])
            ->findOrFail($id);

        return view('admin.subscriptions.show', compact('subscription'));
    }

    // ❌ DELETE
    public function destroy($id)
    {
        Subscription::findOrFail($id)->delete();

        return back()->with('success', 'Subscription deleted');
    }
}
