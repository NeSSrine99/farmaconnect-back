@extends('admin.layout.layout')

@section('content')
    <div class="p-6 bg-gray-50 min-h-screen" style="font-family: 'Plus Jakarta Sans', sans-serif;">

        {{-- HEADER --}}
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Subscriptions</h1>
            <p class="text-sm text-gray-400">Manage recurring orders</p>
        </div>

        {{-- SUCCESS --}}
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        {{-- TABLE --}}
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

            <div class="overflow-x-auto">
                <table class="w-full text-sm">

                    <thead>
                        <tr class="text-xs uppercase text-gray-400 bg-gray-50 border-b">
                            <th class="px-4 py-3 text-left">User</th>
                            <th class="px-4 py-3 text-left">Product</th>
                            <th class="px-4 py-3 text-left">Frequency</th>
                            <th class="px-4 py-3 text-left">Next Delivery</th>
                            <th class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        @forelse($subscriptions as $sub)
                            <tr class="hover:bg-gray-50">

                                {{-- USER --}}
                                <td class="px-4 py-4">
                                    {{ $sub->user->name }}
                                </td>

                                {{-- PRODUCT --}}
                                <td class="px-4 py-4">
                                    {{ $sub->product->name }}
                                </td>

                                {{-- FREQUENCY --}}
                                <td class="px-4 py-4">
                                    <span
                                        class="px-3 py-1 text-xs rounded-full
                                    @if ($sub->frequency == 'daily') bg-green-100 text-green-700
                                    @elseif($sub->frequency == 'weekly') bg-blue-100 text-blue-700
                                    @else bg-purple-100 text-purple-700 @endif">
                                        {{ ucfirst($sub->frequency) }}
                                    </span>
                                </td>

                                {{-- NEXT DELIVERY --}}
                                <td class="px-4 py-4 text-gray-600">
                                    {{ \Carbon\Carbon::parse($sub->next_delivery_date)->format('d M Y') }}
                                </td>

                                {{-- ACTIONS --}}
                                <td class="px-4 py-4 text-right">
                                    <div class="flex justify-end gap-2">

                                        <a href="{{ route('admin.subscriptions.show', $sub->id) }}"
                                            class="px-3 py-1 text-xs bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200">
                                            View
                                        </a>

                                        <form method="POST" action="{{ route('admin.subscriptions.destroy', $sub->id) }}"
                                            onsubmit="return confirm('Delete subscription?')">
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                class="px-3 py-1 text-xs bg-red-100 text-red-600 rounded-lg hover:bg-red-200">
                                                Delete
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-10 text-gray-400">
                                    No subscriptions found
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="p-4 border-t">
                {{ $subscriptions->links() }}
            </div>

        </div>

    </div>
@endsection
