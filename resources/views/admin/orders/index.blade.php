@extends('admin.layout.layout')

@section('content')
    <div class="p-6">

        <!-- Title -->
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Orders Management</h1>

        <!-- Success -->
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Card -->
        <div class="bg-white shadow-md rounded-xl overflow-hidden">

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600">

                    <!-- Header -->
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-4">#ID</th>
                            <th class="px-6 py-4">User</th>
                            <th class="px-6 py-4">Location</th>
                            <th class="px-6 py-4">Payment</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Total</th>
                            <th class="px-6 py-4 text-center">Items</th>
                            <th class="px-6 py-4 text-center">Update</th>
                            <th class="px-6 py-4 text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($orders as $order)
                            <!-- Main Row -->
                            <tr class="border-b hover:bg-gray-50 transition">

                                <!-- ID -->
                                <td class="px-6 py-4 font-semibold text-gray-800">
                                    #{{ $order->id }}
                                </td>

                                <!-- User -->
                                <td class="px-6 py-4">
                                    {{ $order->user->name ?? 'N/A' }}
                                </td>

                                <!-- Location -->
                                <td class="px-6 py-4">
                                    {{ $order->user->address ?? 'No address' }}
                                </td>

                                <!-- Payment -->
                                <td class="px-6 py-4">
                                    <span class="bg-purple-100 text-purple-700 px-2 py-1 rounded text-xs">
                                        {{ $order->payment_method ?? 'Cash' }}
                                    </span>
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4">
                                    @switch($order->status)
                                        @case('pending')
                                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs">
                                                Pending
                                            </span>
                                        @break

                                        @case('confirmed')
                                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs">
                                                Confirmed
                                            </span>
                                        @break

                                        @case('delivered')
                                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">
                                                Delivered
                                            </span>
                                        @break

                                        @default
                                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs">
                                                Rejected
                                            </span>
                                    @endswitch
                                </td>

                                <!-- Total -->
                                <td class="px-6 py-4 font-medium">
                                    ${{ number_format($order->total_price, 2) }}
                                </td>

                                <!-- Toggle Items -->
                                <td class="px-6 py-4 text-center">
                                    <button onclick="loadItems({{ $order->id }})"
                                        class="bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded text-xs">
                                        View Items
                                    </button>
                                </td>

                                <!-- Update Status -->
                                <td class="px-6 py-4 text-center">
                                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST"
                                        class="flex justify-center gap-2">
                                        @csrf

                                        <select name="status" class="border rounded px-2 py-1 text-xs">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>
                                                Confirmed</option>
                                            <option value="rejected" {{ $order->status == 'rejected' ? 'selected' : '' }}>
                                                Rejected</option>
                                            <option value="delivered"
                                                {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                        </select>

                                        <button
                                            class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs">
                                            Save
                                        </button>
                                    </form>
                                </td>

                                <!-- Action -->
                                <td class="px-6 py-4 text-center">
                                    <a href="/admin/orders/{{ $order->id }}"
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-xs">
                                        View
                                    </a>
                                </td>
                            </tr>

                            <!-- AJAX Expand Row -->
                            <tr id="items-{{ $order->id }}" class="hidden bg-gray-50">
                                <td colspan="9" class="p-4">
                                    <div id="items-content-{{ $order->id }}">
                                        Loading...
                                    </div>
                                </td>
                            </tr>

                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-6 text-gray-500">
                                        No orders found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

                <!-- Pagination -->
                <div class="p-4">
                    {{ $orders->links() }}
                </div>

            </div>
        </div>

        <script>
            function loadItems(id) {
                let row = document.getElementById('items-' + id);
                let content = document.getElementById('items-content-' + id);

                if (!row.classList.contains('hidden')) {
                    row.classList.add('hidden');
                    return;
                }

                row.classList.remove('hidden');
                content.innerHTML = "Loading...";

                fetch(`/admin/orders/${id}/items`)
                    .then(response => response.json())
                    .then(order => {

                        let html = `<div class="grid grid-cols-1 md:grid-cols-3 gap-4">`;

                        order.items.forEach(item => {

                            let total = (item.price * item.quantity).toFixed(2);

                            html += `
                    <div class="flex gap-3 bg-white p-3 rounded shadow-sm">

                        <img src="/storage/${item.product.image}" 
                             class="w-14 h-14 object-cover rounded">

                        <div class="text-sm w-full">
                            <p class="font-semibold">
                                ${item.product.name}
                            </p>

                            <p class="text-gray-500 text-xs">
                                Qty: ${item.quantity}
                            </p>

                            <p class="text-gray-500 text-xs">
                                Price: $${item.price}
                            </p>

                            <p class="text-green-600 font-semibold text-xs">
                                Total: $${total}
                            </p>

                            <p class="text-xs ${
                                item.product.requires_prescription
                                    ? 'text-red-600'
                                    : 'text-green-600'
                            }">
                                ${
                                    item.product.requires_prescription
                                        ? 'Prescription Required'
                                        : 'No Prescription'
                                }
                            </p>
                        </div>

                    </div>
                `;
                        });

                        html += `</div>`;
                        content.innerHTML = html;
                    });
            }
        </script>
    @endsection
