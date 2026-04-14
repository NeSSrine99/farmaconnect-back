@extends('admin.layout.layout')

@section('content')
    <div class="p-6 bg-gray-100 min-h-screen">

        {{-- HEADER --}}
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
            <p class="text-sm text-gray-500">Overview of your platform</p>
        </div>

        {{-- STATS CARDS --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

            <div class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white p-5 rounded-xl shadow">
                <p class="text-sm opacity-80">Products</p>
                <h2 class="text-2xl font-bold mt-2">{{ $products }}</h2>
            </div>

            <div class="bg-gradient-to-r from-green-400 to-emerald-500 text-white p-5 rounded-xl shadow">
                <p class="text-sm opacity-80">Orders</p>
                <h2 class="text-2xl font-bold mt-2">{{ $orders }}</h2>
            </div>

            <div class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white p-5 rounded-xl shadow">
                <p class="text-sm opacity-80">Users</p>
                <h2 class="text-2xl font-bold mt-2">{{ $users }}</h2>
            </div>

            <div class="bg-gradient-to-r from-red-400 to-pink-500 text-white p-5 rounded-xl shadow">
                <p class="text-sm opacity-80">Pending Orders</p>
                <h2 class="text-2xl font-bold mt-2">{{ $pendingOrders }}</h2>
            </div>

        </div>

        {{-- MAIN GRID --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- SALES CHART --}}
            <div class="lg:col-span-2 bg-white rounded-xl shadow p-6">
                <h3 class="font-semibold text-gray-700 mb-4">Sales Overview</h3>

                {{-- Fake chart placeholder --}}
                <div
                    class="h-64 bg-gradient-to-r from-indigo-100 to-purple-100 rounded-lg flex items-center justify-center text-gray-400">
                    Chart Here 📊
                </div>
            </div>

            {{-- TRAFFIC / DONUT --}}
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="font-semibold text-gray-700 mb-4">Traffic</h3>

                <div class="h-64 flex items-center justify-center text-gray-400">
                    Donut Chart 🍩
                </div>

                <div class="flex justify-around mt-4 text-sm">
                    <div class="text-center">
                        <p class="font-bold text-gray-700">33%</p>
                        <p class="text-gray-400">Desktop</p>
                    </div>
                    <div class="text-center">
                        <p class="font-bold text-gray-700">55%</p>
                        <p class="text-gray-400">Mobile</p>
                    </div>
                    <div class="text-center">
                        <p class="font-bold text-gray-700">12%</p>
                        <p class="text-gray-400">Tablet</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- SMALL CARDS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">

            <div class="bg-gradient-to-r from-pink-500 to-red-400 text-white p-5 rounded-xl shadow">
                <p class="text-sm">Revenue</p>
                <h2 class="text-xl font-bold mt-2">$432</h2>
            </div>

            <div class="bg-gradient-to-r from-purple-500 to-indigo-500 text-white p-5 rounded-xl shadow">
                <p class="text-sm">Page Views</p>
                <h2 class="text-xl font-bold mt-2">$432</h2>
            </div>

            <div class="bg-gradient-to-r from-orange-400 to-yellow-400 text-white p-5 rounded-xl shadow">
                <p class="text-sm">Bounce Rate</p>
                <h2 class="text-xl font-bold mt-2">$432</h2>
            </div>

        </div>

        {{-- TABLE --}}
        <div class="bg-white rounded-xl shadow mt-6 p-6">
            <h3 class="font-semibold text-gray-700 mb-4">Recent Orders</h3>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="text-gray-500 border-b">
                        <tr>
                            <th class="py-2 text-left">Order</th>
                            <th class="py-2 text-left">Customer</th>
                            <th class="py-2 text-left">Price</th>
                            <th class="py-2 text-left">Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        <tr>
                            <td class="py-2">#1234</td>
                            <td>John Doe</td>
                            <td>$120</td>
                            <td><span class="bg-green-100 text-green-600 px-2 py-1 rounded text-xs">Paid</span></td>
                        </tr>

                        <tr>
                            <td class="py-2">#1235</td>
                            <td>Jane Smith</td>
                            <td>$80</td>
                            <td><span class="bg-yellow-100 text-yellow-600 px-2 py-1 rounded text-xs">Pending</span></td>
                        </tr>

                        <tr>
                            <td class="py-2">#1236</td>
                            <td>Mike Ross</td>
                            <td>$200</td>
                            <td><span class="bg-red-100 text-red-600 px-2 py-1 rounded text-xs">Canceled</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
