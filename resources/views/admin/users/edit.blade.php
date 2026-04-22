@extends('admin.layout.layout')

@section('content')

<div style="font-family: 'Plus Jakarta Sans', sans-serif;">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit User</h1>
        <p class="text-sm text-gray-400">Update user information</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-6 max-w-2xl">

        <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- NAME --}}
            <div>
                <label class="text-sm text-gray-600">Name</label>
                <input type="text" name="name" value="{{ $user->name }}"
                    class="w-full mt-1 px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-cyan-300 outline-none"
                    required>
            </div>

            {{-- EMAIL --}}
            <div>
                <label class="text-sm text-gray-600">Email</label>
                <input type="email" name="email" value="{{ $user->email }}"
                    class="w-full mt-1 px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-cyan-300 outline-none"
                    required>
            </div>

            {{-- PASSWORD --}}
            <div>
                <label class="text-sm text-gray-600">Password (leave empty to keep current)</label>
                <input type="password" name="password"
                    class="w-full mt-1 px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-cyan-300 outline-none">
            </div>

            {{-- ROLE (REAL DB RELATION) --}}
            <div>
                <label class="text-sm text-gray-600">Role</label>

                <select name="role_id"
                    class="w-full mt-1 px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl">

                    @foreach(\App\Models\Role::all() as $role)
                        <option value="{{ $role->id }}"
                            {{ $user->role_id == $role->id ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach

                </select>
            </div>

            {{-- BUTTONS --}}
            <div class="flex justify-end gap-3 pt-2">

                <a href="{{ route('admin.users.index') }}"
                   class="px-4 py-2 rounded-xl bg-gray-100 text-gray-600 hover:bg-gray-200 transition">
                    Cancel
                </a>

                <button class="px-4 py-2 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-500 text-white shadow-md hover:shadow-lg transition">
                    Update User
                </button>

            </div>

        </form>

    </div>

</div>

@endsection