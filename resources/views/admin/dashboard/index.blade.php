{{-- resources/views/admin/dashboard.blade.php --}}

@extends('admin.layout.layout')

@section('content')

<div style="font-family: 'Plus Jakarta Sans', sans-serif;">

    {{-- PAGE TITLE --}}
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
            <p class="text-sm text-gray-400 mt-0.5">Welcome back, {{ auth()->user()->name ?? 'Admin' }} 👋</p>
        </div>
        <div class="flex items-center gap-2 bg-white border border-gray-200 text-gray-600 text-sm font-medium px-4 py-2 rounded-xl shadow-sm cursor-pointer hover:shadow-md transition">
            <svg class="w-4 h-4 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            This Week
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>
    </div>

    {{-- STAT CARDS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-6">

        {{-- Products --}}
        <div class="bg-white rounded-2xl p-5 shadow-sm hover:shadow-md transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center shadow-md shadow-cyan-100"
                    style="background: linear-gradient(135deg, #06b6d4, #3b82f6);">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10" />
                    </svg>
                </div>
                <span class="text-xs font-semibold text-green-500 bg-green-50 px-2 py-1 rounded-full">+12%</span>
            </div>
            <p class="text-3xl font-bold text-gray-800">{{ $products ?? '0' }}</p>
            <p class="text-sm text-gray-400 mt-1">Total Products</p>
        </div>

        {{-- Orders --}}
        <div class="bg-white rounded-2xl p-5 shadow-sm hover:shadow-md transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center shadow-md shadow-emerald-100"
                    style="background: linear-gradient(135deg, #10b981, #059669);">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <span class="text-xs font-semibold text-green-500 bg-green-50 px-2 py-1 rounded-full">+8%</span>
            </div>
            <p class="text-3xl font-bold text-gray-800">{{ $orders ?? '0' }}</p>
            <p class="text-sm text-gray-400 mt-1">Total Orders</p>
        </div>

        {{-- Users --}}
        <div class="bg-white rounded-2xl p-5 shadow-sm hover:shadow-md transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center shadow-md shadow-violet-100"
                    style="background: linear-gradient(135deg, #8b5cf6, #6d28d9);">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <span class="text-xs font-semibold text-green-500 bg-green-50 px-2 py-1 rounded-full">+5%</span>
            </div>
            <p class="text-3xl font-bold text-gray-800">{{ $users ?? '0' }}</p>
            <p class="text-sm text-gray-400 mt-1">Registered Users</p>
        </div>

        {{-- Pending Orders --}}
        <div class="bg-white rounded-2xl p-5 shadow-sm hover:shadow-md transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center shadow-md shadow-orange-100"
                    style="background: linear-gradient(135deg, #f97316, #ef4444);">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="text-xs font-semibold text-red-500 bg-red-50 px-2 py-1 rounded-full">Urgent</span>
            </div>
            <p class="text-3xl font-bold text-gray-800">{{ $pendingOrders ?? '0' }}</p>
            <p class="text-sm text-gray-400 mt-1">Pending Orders</p>
        </div>

    </div>

    {{-- CHARTS ROW --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-6">

        {{-- Sales Chart (2/3 width) --}}
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm p-6">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="font-bold text-gray-800">Order Activity</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Monthly orders overview</p>
                </div>
                <div class="flex gap-2">
                    <button class="text-xs px-3 py-1.5 rounded-lg bg-cyan-50 text-cyan-600 font-semibold">Monthly</button>
                    <button class="text-xs px-3 py-1.5 rounded-lg text-gray-400 hover:bg-gray-50 font-medium">Weekly</button>
                </div>
            </div>
            <div class="h-56">
                <canvas id="ordersChart"></canvas>
            </div>
        </div>

        {{-- Traffic Donut (1/3 width) --}}
        <div class="bg-white rounded-2xl shadow-sm p-6">
            <div class="mb-5">
                <h3 class="font-bold text-gray-800">Order Status</h3>
                <p class="text-xs text-gray-400 mt-0.5">Distribution by status</p>
            </div>
            <div class="h-40 flex items-center justify-center">
                <canvas id="statusChart"></canvas>
            </div>
            <div class="mt-5 space-y-2.5">
                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-emerald-400"></span>
                        <span class="text-gray-500">Completed</span>
                    </div>
                    <span class="font-semibold text-gray-700">48%</span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-amber-400"></span>
                        <span class="text-gray-500">Pending</span>
                    </div>
                    <span class="font-semibold text-gray-700">32%</span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-red-400"></span>
                        <span class="text-gray-500">Rejected</span>
                    </div>
                    <span class="font-semibold text-gray-700">20%</span>
                </div>
            </div>
        </div>

    </div>

    {{-- BOTTOM ROW: Recent Orders + Prescriptions --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

        {{-- Recent Orders Table (2/3) --}}
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm p-6">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="font-bold text-gray-800">Recent Orders</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Latest customer transactions</p>
                </div>
                <a href="{{ route('admin.orders') }}"
                    class="text-xs font-semibold text-cyan-500 hover:text-cyan-600 transition">View All →</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-xs font-semibold text-gray-400 uppercase tracking-wider border-b border-gray-100">
                            <th class="py-3 text-left">Order ID</th>
                            <th class="py-3 text-left">Customer</th>
                            <th class="py-3 text-left">Amount</th>
                            <th class="py-3 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($recentOrders ?? [] as $order)
                        <tr class="hover:bg-gray-50 transition rounded-xl">
                            <td class="py-3 font-semibold text-gray-700">#{{ $order->id }}</td>
                            <td class="py-3">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-7 h-7 rounded-lg flex items-center justify-center text-xs font-bold text-white"
                                        style="background: linear-gradient(135deg, #06b6d4, #3b82f6);">
                                        {{ strtoupper(substr($order->user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <span class="text-gray-700">{{ $order->user->name ?? 'Unknown' }}</span>
                                </div>
                            </td>
                            <td class="py-3 font-semibold text-gray-800">${{ number_format($order->total_price, 2) }}</td>
                            <td class="py-3">
                                @if($order->status === 'completed')
                                    <span class="bg-emerald-50 text-emerald-600 text-xs font-semibold px-2.5 py-1 rounded-full">Completed</span>
                                @elseif($order->status === 'pending')
                                    <span class="bg-amber-50 text-amber-600 text-xs font-semibold px-2.5 py-1 rounded-full">Pending</span>
                                @elseif($order->status === 'approved')
                                    <span class="bg-blue-50 text-blue-600 text-xs font-semibold px-2.5 py-1 rounded-full">Approved</span>
                                @else
                                    <span class="bg-red-50 text-red-500 text-xs font-semibold px-2.5 py-1 rounded-full">Rejected</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        {{-- Fallback static rows --}}
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-3 font-semibold text-gray-700">#1234</td>
                            <td class="py-3">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-7 h-7 rounded-lg flex items-center justify-center text-xs font-bold text-white"
                                        style="background: linear-gradient(135deg, #06b6d4, #3b82f6);">J</div>
                                    <span class="text-gray-700">John Doe</span>
                                </div>
                            </td>
                            <td class="py-3 font-semibold text-gray-800">$120.00</td>
                            <td class="py-3"><span class="bg-emerald-50 text-emerald-600 text-xs font-semibold px-2.5 py-1 rounded-full">Completed</span></td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-3 font-semibold text-gray-700">#1235</td>
                            <td class="py-3">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-7 h-7 rounded-lg flex items-center justify-center text-xs font-bold text-white"
                                        style="background: linear-gradient(135deg, #10b981, #059669);">J</div>
                                    <span class="text-gray-700">Jane Smith</span>
                                </div>
                            </td>
                            <td class="py-3 font-semibold text-gray-800">$80.00</td>
                            <td class="py-3"><span class="bg-amber-50 text-amber-600 text-xs font-semibold px-2.5 py-1 rounded-full">Pending</span></td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-3 font-semibold text-gray-700">#1236</td>
                            <td class="py-3">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-7 h-7 rounded-lg flex items-center justify-center text-xs font-bold text-white"
                                        style="background: linear-gradient(135deg, #f97316, #ef4444);">M</div>
                                    <span class="text-gray-700">Mike Ross</span>
                                </div>
                            </td>
                            <td class="py-3 font-semibold text-gray-800">$200.00</td>
                            <td class="py-3"><span class="bg-red-50 text-red-500 text-xs font-semibold px-2.5 py-1 rounded-full">Rejected</span></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pending Prescriptions (1/3) --}}
        <div class="bg-white rounded-2xl shadow-sm p-6">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="font-bold text-gray-800">Prescriptions</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Awaiting review</p>
                </div>
                <a href="{{ route('admin.prescriptions') }}"
                    class="text-xs font-semibold text-cyan-500 hover:text-cyan-600 transition">View All →</a>
            </div>

            <div class="space-y-3">
                @forelse ($pendingPrescriptions ?? [] as $rx)
                <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 hover:bg-cyan-50 transition group">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0"
                        style="background: linear-gradient(135deg, #06b6d4, #3b82f6);">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-700 truncate">{{ $rx->user->name ?? 'Patient' }}</p>
                        <p class="text-xs text-gray-400">{{ $rx->created_at->diffForHumans() }}</p>
                    </div>
                    <span class="text-xs font-semibold text-amber-600 bg-amber-50 px-2 py-1 rounded-full">Pending</span>
                </div>
                @empty
                {{-- Fallback static items --}}
                @foreach([['Sara Ben Ali', '2 hours ago'], ['Karim Mansour', '5 hours ago'], ['Leila Trabelsi', '1 day ago']] as $rx)
                <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 hover:bg-cyan-50 transition">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0"
                        style="background: linear-gradient(135deg, #06b6d4, #3b82f6);">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-700">{{ $rx[0] }}</p>
                        <p class="text-xs text-gray-400">{{ $rx[1] }}</p>
                    </div>
                    <span class="text-xs font-semibold text-amber-600 bg-amber-50 px-2 py-1 rounded-full">Pending</span>
                </div>
                @endforeach
                @endforelse
            </div>
        </div>

    </div>

</div>

{{-- Charts Script --}}
<script>
    // Orders Bar Chart
    const ctx1 = document.getElementById('ordersChart').getContext('2d');
    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
            datasets: [{
                label: 'Orders',
                data: [30, 55, 40, 70, 50, 90, 65, 80, 45],
                backgroundColor: (ctx) => {
                    const gradient = ctx.chart.ctx.createLinearGradient(0, 0, 0, 200);
                    gradient.addColorStop(0, 'rgba(6, 182, 212, 0.8)');
                    gradient.addColorStop(1, 'rgba(59, 130, 246, 0.3)');
                    return gradient;
                },
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { display: false }, ticks: { color: '#9ca3af', font: { size: 11 } } },
                y: { grid: { color: '#f3f4f6', drawBorder: false }, ticks: { color: '#9ca3af', font: { size: 11 } } }
            }
        }
    });

    // Status Donut Chart
    const ctx2 = document.getElementById('statusChart').getContext('2d');
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Completed', 'Pending', 'Rejected'],
            datasets: [{
                data: [48, 32, 20],
                backgroundColor: ['#34d399', '#fbbf24', '#f87171'],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '72%',
            plugins: { legend: { display: false } }
        }
    });
</script>

@endsection