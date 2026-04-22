@extends('admin.layout.layout')

@section('content')

<div style="font-family: 'Plus Jakarta Sans', sans-serif;">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Users</h1>
            <p class="text-sm text-gray-400 mt-0.5">Manage all registered users</p>
        </div>

        <a href="{{ route('admin.users.create') }}"
           class="flex items-center gap-2 bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-4 py-2 rounded-xl shadow-md hover:shadow-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 4v16m8-8H4"/>
            </svg>
            Add User
        </a>
    </div>

    {{-- SEARCH + FILTER --}}
    <div class="bg-white rounded-2xl shadow-sm p-4 mb-6 flex flex-col md:flex-row gap-3 md:items-center md:justify-between">

        <div class="relative w-full md:w-96">
            <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>

            <input type="text" placeholder="Search users..."
                   class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-cyan-300 focus:outline-none"/>
        </div>

        <div class="text-sm text-gray-400">
            Total: <span class="font-semibold text-gray-700">{{ $users->count() ?? 0 }}</span>
        </div>

    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <thead>
                    <tr class="text-xs uppercase text-gray-400 border-b border-gray-100 bg-gray-50">
                        <th class="py-3 px-4 text-left">User</th>
                        <th class="py-3 px-4 text-left">Email</th>
                        <th class="py-3 px-4 text-left">Role</th>
                        <th class="py-3 px-4 text-left">Joined</th>
                        <th class="py-3 px-4 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-50">

                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50 transition">

                            {{-- USER --}}
                            <td class="py-4 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl flex items-center justify-center text-white font-bold"
                                         style="background: linear-gradient(135deg, #06b6d4, #3b82f6);">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>

                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $user->name }}</p>
                                        <p class="text-xs text-gray-400">ID: {{ $user->id }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- EMAIL --}}
                            <td class="py-4 px-4 text-gray-600">
                                {{ $user->email }}
                            </td>

                            {{-- ROLE --}}
                            <td class="py-4 px-4">
                                @if($user->role === 'admin')
                                    <span class="text-xs font-semibold px-2 py-1 rounded-full bg-purple-50 text-purple-600">
                                        Admin
                                    </span>
                                @else
                                    <span class="text-xs font-semibold px-2 py-1 rounded-full bg-cyan-50 text-cyan-600">
                                        User
                                    </span>
                                @endif
                            </td>

                            {{-- DATE --}}
                            <td class="py-4 px-4 text-gray-500 text-sm">
                                {{ $user->created_at->format('d M Y') }}
                            </td>

                            {{-- ACTIONS --}}
                            <td class="py-4 px-4">
                                <div class="flex items-center justify-end gap-2">

                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                       class="p-2 rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-100 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M11 5h2m-1 0v14m-7-7h14"/>
                                        </svg>
                                    </a>

                                    {{-- DELETE --}}
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                          onsubmit="return confirm('Delete this user?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="p-2 rounded-xl bg-red-50 text-red-500 hover:bg-red-100 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
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

    </div>

</div>

@endsection