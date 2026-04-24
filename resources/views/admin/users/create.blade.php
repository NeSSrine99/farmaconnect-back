@extends('admin.layout.layout')

@section('content')
    <div class="p-6 max-w-2xl">

        <h1 class="text-2xl font-bold mb-4">Create User</h1>

        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-4">
            @csrf

            <input type="text" name="name" placeholder="Name" class="w-full border p-2 rounded" required>
            <input type="email" name="email" placeholder="Email" class="w-full border p-2 rounded" required>
            <input type="password" name="password" placeholder="Password" class="w-full border p-2 rounded" required>

            {{-- ROLE --}}
            <select name="role_id" class="w-full border p-2 rounded">
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">
                        {{ ucfirst($role->name) }}
                    </option>
                @endforeach
            </select>

            <button class="bg-blue-500 text-white px-4 py-2 rounded">Create</button>
        </form>

    </div>
@endsection
