@extends('admin.layout.layout')

@section('content')
    <div class="p-6 bg-gray-50 min-h-screen" style="font-family: 'Plus Jakarta Sans', sans-serif;">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

            <div>
                <h1 class="text-3xl font-bold text-gray-800">Users</h1>
                <p class="text-sm text-gray-400 mt-1">Manage all registered users</p>
            </div>

            <a href="{{ route('admin.users.create') }}"
                class="flex items-center gap-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white px-5 py-2.5 rounded-xl shadow hover:shadow-lg transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add User
            </a>

        </div>

        {{-- STATS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

            <div class="bg-white rounded-2xl p-4 shadow-sm">
                <p class="text-gray-400 text-sm">Total Users</p>
                <h2 class="text-2xl font-bold text-gray-800 mt-1">
                    {{ $users->total() }}
                </h2>
            </div>

            <div class="bg-white rounded-2xl p-4 shadow-sm">
                <p class="text-gray-400 text-sm">Admins</p>
                <h2 class="text-2xl font-bold text-purple-600 mt-1">
                    {{ $users->where('role.name', 'admin')->count() }}
                </h2>
            </div>

            <div class="bg-white rounded-2xl p-4 shadow-sm">
                <p class="text-gray-400 text-sm">Pharmacists</p>
                <h2 class="text-2xl font-bold text-green-600 mt-1">
                    {{ $users->where('role.name', 'pharmacist')->count() }}
                </h2>
            </div>

        </div>

        {{-- SEARCH --}}
        <div class="bg-white rounded-2xl shadow-sm p-4 mb-6 flex items-center justify-between">

            <div class="relative w-full md:w-96">
                <input type="text" placeholder="Search users..."
                    class="w-full pl-4 pr-10 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-cyan-300 focus:outline-none">

                <svg class="w-4 h-4 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            <span class="text-sm text-gray-400 hidden md:block">
                Showing {{ $users->count() }} of {{ $users->total() }}
            </span>

        </div>

        {{-- TABLE --}}
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

            <div class="overflow-x-auto">
                <table class="w-full text-sm">

                    <thead>
                        <tr class="text-xs uppercase text-gray-400 bg-gray-50 border-b">
                            <th class="py-3 px-4 text-left">User</th>
                            <th class="py-3 px-4 text-left">Email</th>
                            <th class="py-3 px-4 text-left">Role</th>
                            <th class="py-3 px-4 text-left">Joined</th>
                            <th class="py-3 px-4 text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        @forelse($users as $user)
                            <tr class="hover:bg-gray-50 transition">

                                {{-- USER --}}
                                <td class="py-4 px-4">
                                    <div class="flex items-center gap-3">

                                        <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white font-bold shadow"
                                            style="background: linear-gradient(135deg, #06b6d4, #3b82f6);">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>

                                        <div>
                                            <p class="font-semibold text-gray-800">
                                                {{ $user->name }}
                                            </p>
                                            <p class="text-xs text-gray-400">
                                                ID: {{ $user->id }}
                                            </p>
                                        </div>

                                    </div>
                                </td>

                                {{-- EMAIL --}}
                                <td class="py-4 px-4 text-gray-600">
                                    {{ $user->email }}
                                </td>

                                {{-- ROLE --}}
                                <td class="py-4 px-4">
                                    @php
                                        $role = strtolower($user->role->name ?? 'user');
                                    @endphp

                                    <span
                                        class="px-3 py-1 text-xs font-semibold rounded-full
                                    @if ($role === 'admin') bg-purple-100 text-purple-700
                                    @elseif($role === 'pharmacist') bg-green-100 text-green-700
                                    @else bg-cyan-100 text-cyan-700 @endif
                                ">
                                        {{ ucfirst($role) }}
                                    </span>
                                </td>

                                {{-- DATE --}}
                                <td class="py-4 px-4 text-gray-500">
                                    {{ $user->created_at->format('d M Y') }}
                                </td>

                                {{-- ACTIONS --}}
                                <td class="py-4 px-4">
                                    <div class="flex justify-end gap-2">

                                        <a href="{{ route('admin.users.show', $user->id) }}"
                                            class="px-3 py-1 text-xs bg-gray-100 rounded-lg hover:bg-gray-200">
                                            View
                                        </a>

                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                            class="px-3 py-1 text-xs bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Delete this user?')">
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
                                    No users found
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="p-4 border-t">
                {{ $users->links() }}
            </div>

        </div>

    </div>
@endsection
