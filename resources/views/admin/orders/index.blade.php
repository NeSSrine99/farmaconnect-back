@extends('admin.layout.layout')

@section('content')
    <h1 class="text-xl font-bold mb-4">Orders</h1>

    <table class="w-full border">
        <tr class="bg-gray-200">
            <th>ID</th>
            <th>Status</th>
            <th>Total</th>
            <th>Action</th>
        </tr>

        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->total_price }}</td>
                <td>
                    <a href="/admin/orders/{{ $order->id }}">View</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
