@extends('admin.layout.layout')

@section('content')

<div style="font-family: 'Plus Jakarta Sans', sans-serif;">

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">User Details</h1>
            <p class="text-sm text-gray-400">Full information about the user</p>
        </div>

        <a href="{{ route('admin.users.index') }}"
           class="px-4 py-2 rounded-xl bg-gray-100 text-gray-600 hover:bg-gray-200 transition">
            Back
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-6 max-w-2xl">

        <div class="flex items-center gap-4 mb-6">

            <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-white text-xl font-bold"
                 style="background: linear-gradient(135deg, #06b6d4, #3b82f6);">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>

            <div>
                <h2 class="text-xl font-bold text-gray-800">{{ $user->name }}</h2>
                <p class="text-sm text-gray-400">{{ $user->email }}</p>
            </div>

        </div>

        <div class="space-y-3 text-sm">

            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-400">Role</span>
                <span class="font-semibold text-gray-700">{{ $user->role }}</span>
            </div>

            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-400">Created At</span>
                <span class="font-semibold text-gray-700">{{ $user->created_at }}</span>
            </div>

            <div class="flex justify-between">
                <span class="text-gray-400">Updated At</span>
                <span class="font-semibold text-gray-700">{{ $user->updated_at }}</span>
            </div>

        </div>

    </div>

</div>

@endsection