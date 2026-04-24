@extends('admin.layout.layout')

@section('content')
    <div class="p-6 max-w-3xl mx-auto">

        <h1 class="text-2xl font-bold mb-4">Consultation Details</h1>

        {{-- USER --}}
        <div class="mb-3">
            <strong>User:</strong> {{ $consultation->user->name }}
        </div>

        {{-- PHARMACIST --}}
        <div class="mb-3">
            <strong>Pharmacist:</strong> {{ $consultation->pharmacien->name }}
        </div>

        {{-- MESSAGE --}}
        <div class="mb-3">
            <strong>Message:</strong>
            <p class="bg-gray-100 p-3 rounded mt-1">
                {{ $consultation->message }}
            </p>
        </div>

        {{-- REPLY --}}
        <div class="mb-3">
            <strong>Reply:</strong>

            @if ($consultation->reply)
                <p class="bg-green-100 p-3 rounded mt-1">
                    {{ $consultation->reply }}
                </p>
            @else
                <form method="POST" action="{{ route('admin.consultations.reply', $consultation->id) }}">
                    @csrf

                    <textarea name="reply" class="w-full border p-2 rounded mt-2" placeholder="Write reply..." required></textarea>

                    <button class="mt-2 bg-green-500 text-white px-4 py-2 rounded">
                        Send Reply
                    </button>
                </form>
            @endif
        </div>

    </div>
@endsection
