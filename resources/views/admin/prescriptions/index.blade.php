@extends('admin.layout.layout')

@section('content')
    <h1 class="text-xl font-bold mb-4">Prescriptions</h1>

    <table class="w-full border text-center">
        <tr class="bg-gray-200">
            <th>ID</th>
            <th>User</th>
            <th>File</th>
            <th>Status</th>
            <th>Reviewed By</th>
            <th>Actions</th>
        </tr>

        @foreach ($prescriptions as $p)
            <tr class="border">

                <td>{{ $p->id }}</td>

                <!-- User -->
                <td>{{ $p->user_id }}</td>

                <!-- FILE -->
                <td>
                    @if ($p->file)
                        <a href="{{ asset('storage/' . $p->file) }}" target="_blank" class="text-blue-500">
                            View File
                        </a>
                    @else
                        <span class="text-gray-400">No File</span>
                    @endif
                </td>

                <!-- Status -->
                <td>
                    <span
                        class="
                px-2 py-1 rounded
                @if ($p->status == 'approved') bg-green-500 text-white
                @elseif($p->status == 'rejected') bg-red-500 text-white
                @else bg-yellow-500 text-white @endif
            ">
                        {{ $p->status }}
                    </span>
                </td>

                <!-- Reviewed By -->
                <td>{{ $p->reviewed_by ?? '-' }}</td>

                <!-- Actions -->
                <td class="space-x-2">
                    <a href="/admin/prescriptions/{{ $p->id }}/approved"
                        class="bg-green-500 text-white px-2 py-1 rounded">
                        Approve
                    </a>

                    <a href="/admin/prescriptions/{{ $p->id }}/rejected"
                        class="bg-red-500 text-white px-2 py-1 rounded">
                        Reject
                    </a>
                </td>

            </tr>
        @endforeach

    </table>
@endsection
