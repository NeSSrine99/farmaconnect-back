@extends('admin.layout.layout')

@section('content')
    <div class="p-6 max-w-2xl mx-auto">

        <h1 class="text-2xl font-bold mb-4">Subscription Details</h1>

        <div class="space-y-3 text-sm">

            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-400">User</span>
                <span class="font-semibold">{{ $subscription->user->name }}</span>
            </div>

            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-400">Product</span>
                <span class="font-semibold">{{ $subscription->product->name }}</span>
            </div>

            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-400">Frequency</span>
                <span class="font-semibold">{{ ucfirst($subscription->frequency) }}</span>
            </div>

            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-400">Next Delivery</span>
                <span class="font-semibold">
                    {{ \Carbon\Carbon::parse($subscription->next_delivery_date)->format('d M Y') }}
                </span>
            </div>

        </div>

    </div>
@endsection
