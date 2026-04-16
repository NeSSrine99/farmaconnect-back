@extends('admin.layout.layout')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">

  <div class="max-w-3xl mx-auto space-y-5">

    <div class="flex items-center justify-between">
      <div class="flex items-center gap-3">
        <a href="{{ route('admin.products.index') }}"
           class="bg-white border border-gray-200 text-gray-500 text-sm font-bold px-4 py-2 rounded-lg hover:border-teal-500 hover:text-teal-600 transition">
          ← Retour
        </a>
        <h1 class="text-xl font-extrabold text-gray-800">Modifier produit</h1>
      </div>

      {{-- DELETE BUTTON --}}
      <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
            onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?')">
        @csrf
        @method('DELETE')
        <button class="bg-red-50 border border-red-200 text-red-600 text-sm font-bold px-4 py-2 rounded-lg hover:bg-red-600 hover:text-white transition">
          Supprimer
        </button>
      </form>
    </div>

    {{-- ERRORS --}}
    @if($errors->any())
      <div class="bg-red-50 text-red-600 border border-red-200 rounded-lg p-4 text-sm font-semibold">
        @foreach($errors->all() as $e)
          <div>• {{ $e }}</div>
        @endforeach
      </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-5">

      @csrf
      @method('PUT')

      {{-- GENERAL --}}
      <div class="bg-white rounded-xl border border-gray-100 p-5">
        <h2 class="text-xs font-extrabold uppercase text-teal-700 border-b-2 border-teal-50 pb-2 mb-4">
          Informations générales
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

          <input name="name" value="{{ $product->name }}"
                 class="w-full border rounded-lg px-3 py-2 text-sm">

          <input name="brand" value="{{ $product->brand }}"
                 class="w-full border rounded-lg px-3 py-2 text-sm">

          <div class="md:col-span-2">
            <textarea name="description"
                      class="w-full border rounded-lg px-3 py-2 text-sm">{{ $product->description }}</textarea>
          </div>

          <select name="category_id" class="w-full border rounded-lg px-3 py-2 text-sm">
            @foreach($categories as $cat)
              <option value="{{ $cat->id }}"
                {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
              </option>
            @endforeach
          </select>

        </div>
      </div>

      {{-- PRICE & STOCK --}}
      <div class="bg-white rounded-xl border border-gray-100 p-5">
        <h2 class="text-xs font-extrabold uppercase text-teal-700 border-b-2 border-teal-50 pb-2 mb-4">
          Prix & Stock
        </h2>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">

          <input type="number" step="0.01" name="price"
                 value="{{ $product->price }}"
                 class="w-full border rounded-lg px-3 py-2 text-sm">

          <input type="number" step="0.01" name="discount"
                 value="{{ $product->discount }}"
                 class="w-full border rounded-lg px-3 py-2 text-sm">

          <input type="number" name="stock"
                 value="{{ $product->stock }}"
                 class="w-full border rounded-lg px-3 py-2 text-sm">

          <select name="availability" class="w-full border rounded-lg px-3 py-2 text-sm">
            <option value="in stock" {{ $product->availability == 'in stock' ? 'selected' : '' }}>
              En stock
            </option>
            <option value="out of stock" {{ $product->availability == 'out of stock' ? 'selected' : '' }}>
              Rupture
            </option>
          </select>

        </div>
      </div>

      {{-- IMAGE --}}
      <div class="bg-white rounded-xl border border-gray-100 p-5">
        <h2 class="text-xs font-extrabold uppercase text-teal-700 border-b-2 border-teal-50 pb-2 mb-4">
          Image produit
        </h2>

        @if($product->image)
          <img src="{{ asset('storage/' . $product->image) }}"
               class="w-20 h-20 rounded mb-3">
        @endif

        <input type="file" name="image"
               class="w-full border border-dashed rounded-lg p-3 text-sm">
      </div>

      {{-- OPTIONS --}}
      <div class="bg-white rounded-xl border border-gray-100 p-5">
        <h2 class="text-xs font-extrabold uppercase text-teal-700 border-b-2 border-teal-50 pb-2 mb-4">
          Options
        </h2>

        <div class="grid grid-cols-2 gap-3">

          <label class="flex items-center gap-2">
            <input type="checkbox" name="isNew" {{ $product->isNew ? 'checked' : '' }}>
            Nouveau
          </label>

          <label class="flex items-center gap-2">
            <input type="checkbox" name="requiresPrescription" {{ $product->requiresPrescription ? 'checked' : '' }}>
            Ordonnance
          </label>

        </div>
      </div>

      <div class="flex justify-end gap-3">
        <button type="submit"
                class="bg-teal-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-teal-700">
          Mettre à jour
        </button>
      </div>

    </form>

  </div>
</div>
@endsection