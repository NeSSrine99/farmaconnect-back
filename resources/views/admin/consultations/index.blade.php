@extends('admin.layout.layout')

@section('content')
    <div class="p-6 bg-gray-50 min-h-screen" style="font-family: 'Plus Jakarta Sans', sans-serif;">

        {{-- HEADER --}}
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Consultations</h1>
            <p class="text-sm text-gray-400">Manage client & pharmacist messages</p>
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
                            <th class="px-4 py-3 text-left">Pharmacist</th>
                            <th class="px-4 py-3 text-left">Message</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        @forelse($consultations as $c)
                            <tr class="hover:bg-gray-50 transition">

                                {{-- USER --}}
                                <td class="px-4 py-4">
                                    {{ $c->user->name ?? 'N/A' }}
                                </td>

                                {{-- PHARMACIST --}}
                                <td class="px-4 py-4">
                                    {{ $c->pharmacien->name ?? 'N/A' }}
                                </td>

                                {{-- MESSAGE --}}
                                <td class="px-4 py-4 text-gray-600 max-w-xs truncate">
                                    {{ $c->message }}
                                </td>

                                {{-- STATUS --}}
                                <td class="px-4 py-4">
                                    @if ($c->reply)
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">
                                            Replied
                                        </span>
                                    @else
                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs">
                                            Pending
                                        </span>
                                    @endif
                                </td>

                                {{-- ACTIONS --}}
                                <td class="px-4 py-4 text-right">
                                    <div class="flex justify-end gap-2">

                                        <a href="{{ route('admin.consultations.show', $c->id) }}"
                                            class="px-3 py-1 text-xs bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200">
                                            View
                                        </a>

                                        <form method="POST" action="{{ route('admin.consultations.destroy', $c->id) }}"
                                            onsubmit="return confirm('Delete this consultation?')">
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
                                    No consultations found
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="p-4 border-t">
                {{ $consultations->links() }}
            </div>

        </div>

    </div>
@endsection
