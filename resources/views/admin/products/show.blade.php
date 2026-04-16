@extends('admin.layout.layout')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">

  <div class="max-w-3xl mx-auto bg-white rounded-xl shadow p-6 space-y-4">

    <div class="flex justify-between items-center">
      <h1 class="text-2xl font-bold">{{ $product->name }}</h1>

      <div class="flex gap-2">
        <a href="{{ route('admin.products.edit', $product->id) }}"
           class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm">
          Edit
        </a>

        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
              onsubmit="return confirm('Delete product?')">
          @csrf
          @method('DELETE')
          <button class="bg-red-500 text-white px-4 py-2 rounded-lg text-sm">
            Delete
          </button>
        </form>
      </div>
    </div>

    @if($product->image)
      <img src="{{ asset('storage/' . $product->image) }}"
           class="w-full h-64 object-cover rounded-lg">
    @endif

    <p class="text-gray-600">{{ $product->description }}</p>

    <div class="grid grid-cols-2 gap-3 text-sm">
      <div><b>Price:</b> {{ $product->price }}</div>
      <div><b>Stock:</b> {{ $product->stock }}</div>
      <div><b>Brand:</b> {{ $product->brand }}</div>
      <div><b>Availability:</b> {{ $product->availability }}</div>
    </div>

  </div>

</div>
@endsection