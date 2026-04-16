@extends('admin.layout.layout')
@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
  <div class="max-w-3xl mx-auto space-y-5">

    <div class="flex items-center gap-3">
      <a href="{{ route('admin.products.index') }}" class="bg-white border border-gray-200 text-gray-500 text-sm font-bold px-4 py-2 rounded-lg hover:border-teal-500 hover:text-teal-600 transition">← Retour</a>
      <h1 class="text-xl font-extrabold text-gray-800">Ajouter un produit</h1>
    </div>

    @if($errors->any())
      <div class="bg-red-50 text-red-600 border border-red-200 rounded-lg p-4 text-sm font-semibold">
        @foreach($errors->all() as $e) <div>• {{ $e }}</div> @endforeach
      </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
      @csrf

      {{-- Informations générales --}}
      <div class="bg-white rounded-xl border border-gray-100 p-5">
        <h2 class="text-xs font-extrabold uppercase tracking-widest text-teal-700 border-b-2 border-teal-50 pb-2 mb-4">Informations générales</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="text-xs font-bold text-gray-500 mb-1 block">Nom du produit <span class="text-red-500">*</span></label>
            <input name="name" type="text" placeholder="ex. Cetaphil Sun SPF 50+" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-teal-500 outline-none" required>
          </div>
          <div>
            <label class="text-xs font-bold text-gray-500 mb-1 block">Marque <span class="text-red-500">*</span></label>
            <input name="brand" type="text" placeholder="ex. Cetaphil" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-teal-500 outline-none" required>
          </div>
          <div class="md:col-span-2">
            <label class="text-xs font-bold text-gray-500 mb-1 block">Description</label>
            <textarea name="description" rows="3" placeholder="Description, ingrédients, mode d'emploi..." class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-teal-500 outline-none resize-y"></textarea>
          </div>
          <div>
            <label class="text-xs font-bold text-gray-500 mb-1 block">Catégorie <span class="text-red-500">*</span></label>
            <select name="category_id" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-teal-500 outline-none" required>
              <option value="">Sélectionner...</option>
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label class="text-xs font-bold text-gray-500 mb-1 block">Référence / SKU</label>
            <input name="sku" type="text" placeholder="ex. CTF-SUN-50" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-teal-500 outline-none">
          </div>
        </div>
      </div>

      {{-- Prix & Stock --}}
      <div class="bg-white rounded-xl border border-gray-100 p-5">
        <h2 class="text-xs font-extrabold uppercase tracking-widest text-teal-700 border-b-2 border-teal-50 pb-2 mb-4">Prix & Stock</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
          <div>
            <label class="text-xs font-bold text-gray-500 mb-1 block">Prix (TND) <span class="text-red-500">*</span></label>
            <input name="price" type="number" step="0.01" min="0" placeholder="0.00" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-teal-500 outline-none" required>
          </div>
          <div>
            <label class="text-xs font-bold text-gray-500 mb-1 block">Ancien prix (TND)</label>
            <input name="price_old" type="number" step="0.01" min="0" placeholder="0.00" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-teal-500 outline-none">
          </div>
          <div>
            <label class="text-xs font-bold text-gray-500 mb-1 block">Remise (%)</label>
            <input name="discount" type="number" min="0" max="100" placeholder="0" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-teal-500 outline-none">
          </div>
          <div>
            <label class="text-xs font-bold text-gray-500 mb-1 block">Stock</label>
            <input name="stock" type="number" min="0" placeholder="0" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-teal-500 outline-none">
          </div>
          <div>
            <label class="text-xs font-bold text-gray-500 mb-1 block">Disponibilité</label>
            <select name="availability" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-teal-500 outline-none">
              <option value="in stock">En stock</option>
              <option value="out of stock">Rupture</option>
            </select>
          </div>
        </div>
      </div>

      {{-- Image --}}
      <div class="bg-white rounded-xl border border-gray-100 p-5">
        <h2 class="text-xs font-extrabold uppercase tracking-widest text-teal-700 border-b-2 border-teal-50 pb-2 mb-4">Image produit</h2>
        <input type="file" name="image" accept="image/*" class="w-full border border-dashed border-gray-300 rounded-lg p-4 text-sm text-gray-500 cursor-pointer hover:border-teal-400 hover:bg-teal-50 transition">
      </div>

      {{-- Options --}}
      <div class="bg-white rounded-xl border border-gray-100 p-5">
        <h2 class="text-xs font-extrabold uppercase tracking-widest text-teal-700 border-b-2 border-teal-50 pb-2 mb-4">Options</h2>
        <div class="grid grid-cols-2 gap-3">
          @foreach([['isNew','Nouveau produit'],['requiresPrescription','Ordonnance requise'],['isFeatured','Mise en avant'],['isBestSeller','Best Seller']] as [$n,$l])
          <label class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 cursor-pointer hover:border-teal-400 transition">
            <input type="checkbox" name="{{ $n }}" class="accent-teal-600 w-4 h-4">
            <span class="text-sm font-bold text-gray-700">{{ $l }}</span>
          </label>
          @endforeach
        </div>
      </div>

      <div class="flex justify-end gap-3">
        <a href="{{ route('admin.products.index') }}" class="bg-white border border-gray-200 text-gray-500 text-sm font-bold px-5 py-2.5 rounded-lg hover:border-red-400 hover:text-red-500 transition">Annuler</a>
        <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white text-sm font-extrabold px-6 py-2.5 rounded-lg transition">Enregistrer le produit</button>
      </div>

    </form>
  </div>
</div>
@endsection