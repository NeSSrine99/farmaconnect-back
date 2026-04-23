@extends('admin.layout.layout')

@section('content')
    <div class="p-6 max-w-5xl mx-auto">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Order #{{ $order->id }}</h1>

            <span class="px-3 py-1 text-xs rounded-full bg-gray-200">
                {{ ucfirst($order->status) }}
            </span>
        </div>

        <!-- Customer Info -->
        <div class="bg-white p-5 rounded-xl shadow mb-6">
            <h2 class="font-semibold mb-3">Customer Info</h2>

            <div class="grid grid-cols-2 gap-4 text-sm">
                <p><strong>Name:</strong> {{ $order->user->name }}</p>
                <p><strong>Email:</strong> {{ $order->user->email }}</p>
                <p><strong>Address:</strong> {{ $order->user->address ?? 'N/A' }}</p>
                <p><strong>Payment:</strong> {{ $order->payment_method ?? 'Cash' }}</p>
            </div>
        </div>

        <!-- Items -->
        <div class="bg-white p-5 rounded-xl shadow mb-6">

            <h2 class="font-semibold mb-4">Order Items</h2>

            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-xs uppercase">
                    <tr>
                        <th class="p-3 text-left">Product</th>
                        <th class="p-3">Qty</th>
                        <th class="p-3">Price</th>
                        <th class="p-3">Total</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($order->items as $item)
                        <tr class="border-b">

                            <td class="p-3 flex items-center gap-3">
                                <img src="{{ asset('storage/' . $item->product->image) }}"
                                    class="w-12 h-12 rounded object-cover">

                                <div>
                                    <p class="font-semibold">
                                        {{ $item->product->name }}
                                    </p>

                                    <p
                                        class="text-xs {{ $item->product->requires_prescription ? 'text-red-600' : 'text-green-600' }}">
                                        {{ $item->product->requires_prescription ? 'Prescription Required' : 'No Prescription' }}
                                    </p>
                                </div>
                            </td>

                            <td class="p-3 text-center">
                                {{ $item->quantity }}
                            </td>

                            <td class="p-3 text-center">
                                ${{ number_format($item->price, 2) }}
                            </td>

                            <td class="p-3 text-center font-semibold text-green-600">
                                ${{ number_format($item->price * $item->quantity, 2) }}
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        <!-- Total -->
        <div class="bg-white p-5 rounded-xl shadow flex justify-end">
            <div class="text-right">
                <p class="text-sm text-gray-500">Total Amount</p>
                <h2 class="text-xl font-bold text-green-600">
                    ${{ number_format($order->total_price, 2) }}
                </h2>
            </div>
        </div>

    </div>
@endsection
