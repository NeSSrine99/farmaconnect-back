@extends('admin.layout.layout')

@section('content')
    <div class="p-6 bg-gray-100 min-h-screen">

        <div class="max-w-5xl mx-auto bg-white rounded-xl shadow p-6">

            <h1 class="text-2xl font-bold text-gray-800 mb-6">Modifier Produit</h1>

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <input name="name" value="{{ $product->name }}" class="input">

                    <input name="brand" value="{{ $product->brand }}" class="input">

                    <input name="manufacturer" value="{{ $product->manufacturer }}" class="input">

                    <input type="number" step="0.01" name="price" value="{{ $product->price }}" class="input">

                    <input type="number" step="0.01" name="discount" value="{{ $product->discount }}" class="input">

                    <input type="number" name="stock" value="{{ $product->stock }}" class="input">

                    <select name="category_id" class="input">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    <select name="availability" class="input">
                        <option value="in stock" {{ $product->availability == 'in stock' ? 'selected' : '' }}>En stock
                        </option>
                        <option value="out of stock" {{ $product->availability == 'out of stock' ? 'selected' : '' }}>
                            Rupture</option>
                    </select>

                    <input name="dosageForm" value="{{ $product->dosageForm }}" class="input">

                    <input name="strength" value="{{ $product->strength }}" class="input">

                    <input type="date" name="expiryDate" value="{{ $product->expiryDate }}" class="input">

                    <input name="barcode" value="{{ $product->barcode }}" class="input">

                    <input name="batch_number" value="{{ $product->batch_number }}" class="input">

                    <div class="flex items-center gap-4">
                        <label class="flex items-center gap-2 text-sm">
                            <input type="checkbox" name="isNew" {{ $product->isNew ? 'checked' : '' }} class="checkbox">
                            Nouveau
                        </label>

                        <label class="flex items-center gap-2 text-sm">
                            <input type="checkbox" name="requiresPrescription"
                                {{ $product->requiresPrescription ? 'checked' : '' }} class="checkbox">
                            Ordonnance
                        </label>
                    </div>

                    {{-- IMAGE --}}
                    <div>
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
                                class="w-20 h-20 object-cover rounded mb-2">
                        @endif
                        <input type="file" name="image" class="input">
                    </div>

                </div>

                <div class="mt-6 space-y-3">
                    <textarea name="description" class="textarea">{{ $product->description }}</textarea>
                    <textarea name="ingredients" class="textarea">{{ $product->ingredients }}</textarea>
                    <textarea name="usage" class="textarea">{{ $product->usage }}</textarea>
                    <textarea name="sideEffects" class="textarea">{{ $product->sideEffects }}</textarea>
                    <textarea name="warning" class="textarea">{{ $product->warning }}</textarea>
                    <textarea name="storage" class="textarea">{{ $product->storage }}</textarea>
                </div>

                <button class="mt-6 bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                    Mettre à jour
                </button>

            </form>

        </div>
    </div>
@endsection
