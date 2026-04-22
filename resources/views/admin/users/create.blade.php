@extends('admin.layout.layout')

@section('content')

<div style="font-family: 'Plus Jakarta Sans', sans-serif;">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Create User</h1>
        <p class="text-sm text-gray-400">Add a new user to the system</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-6 max-w-2xl">

        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-5">
            @csrf

            {{-- NAME --}}
            <div>
                <label class="text-sm text-gray-600">Name</label>
                <input type="text" name="name"
                    class="w-full mt-1 px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-cyan-300 outline-none"
                    required>
            </div>

            {{-- EMAIL --}}
            <div>
                <label class="text-sm text-gray-600">Email</label>
                <input type="email" name="email"
                    class="w-full mt-1 px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-cyan-300 outline-none"
                    required>
            </div>

            {{-- PASSWORD --}}
            <div>
                <label class="text-sm text-gray-600">Password</label>
                <input type="password" name="password"
                    class="w-full mt-1 px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-cyan-300 outline-none"
                    required>
            </div>

            {{-- ROLE --}}
            <div>
                <label class="text-sm text-gray-600">Role</label>
                <select name="role"
                    class="w-full mt-1 px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-cyan-300 outline-none">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            {{-- BUTTONS --}}
            <div class="flex justify-end gap-3 pt-2">

                <a href="{{ route('admin.users.index') }}"
                   class="px-4 py-2 rounded-xl bg-gray-100 text-gray-600 hover:bg-gray-200 transition">
                    Cancel
                </a>

                <button class="px-4 py-2 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-500 text-white shadow-md hover:shadow-lg transition">
                    Create User
                </button>

            </div>

        </form>

    </div>

</div>

@endsection