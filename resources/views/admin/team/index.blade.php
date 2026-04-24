@extends('admin.layout.layout')

@section('content')
    <div class="p-6 bg-gray-50 min-h-screen" style="font-family: 'Plus Jakarta Sans', sans-serif;">

        {{-- HEADER --}}
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Pharmacists Team</h1>
                <p class="text-sm text-gray-400">All registered pharmacists</p>
            </div>
        </div>

        {{-- GRID --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            @forelse($pharmaciens as $user)
                <div class="bg-white rounded-2xl shadow-sm p-5 hover:shadow-md transition">

                    {{-- AVATAR --}}
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white font-bold text-lg shadow"
                            style="background: linear-gradient(135deg, #10b981, #059669);">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>

                        <div>
                            <h2 class="font-semibold text-gray-800">{{ $user->name }}</h2>
                            <p class="text-xs text-gray-400">ID: {{ $user->id }}</p>
                        </div>
                    </div>

                    {{-- INFO --}}
                    <div class="text-sm text-gray-600 space-y-1">
                        <p><span class="text-gray-400">Email:</span> {{ $user->email }}</p>
                    </div>

                    {{-- ROLE BADGE --}}
                    <div class="mt-4">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                            Pharmacist
                        </span>
                    </div>

                    {{-- ACTION --}}
                    <div class="mt-4 flex justify-end">
                        <a href="{{ route('admin.users.show', $user->id) }}"
                            class="text-xs bg-gray-100 px-3 py-1 rounded-lg hover:bg-gray-200">
                            View
                        </a>
                    </div>

                </div>

            @empty
                <div class="col-span-full text-center text-gray-400 py-10">
                    No pharmacists found
                </div>
            @endforelse

        </div>

        {{-- PAGINATION --}}
        <div class="mt-6">
            {{ $pharmaciens->links() }}
        </div>

    </div>
@endsection
