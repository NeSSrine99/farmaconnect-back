@extends('admin.layout.layout')

@section('content')
    <div class="p-6 bg-gray-100 min-h-screen">

        <div class="max-w-5xl mx-auto bg-white rounded-xl shadow p-6">

            <h1 class="text-2xl font-bold text-gray-800 mb-6">Ajouter Produit</h1>

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <input name="name" placeholder="Nom" class="input" required>

                    <input name="brand" placeholder="Marque" class="input">

                    <input name="manufacturer" placeholder="Fabricant" class="input">

                    <input type="number" step="0.01" name="price" placeholder="Prix" class="input" required>

                    <input type="number" step="0.01" name="discount" placeholder="Remise" class="input">

                    <input type="number" name="stock" placeholder="Stock" class="input">

                    <select name="category_id" class="input">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>

                    <select name="availability" class="input">
                        <option value="in stock">En stock</option>
                        <option value="out of stock">Rupture</option>
                    </select>

                    <input name="dosageForm" placeholder="Forme" class="input">

                    <input name="strength" placeholder="Dosage" class="input">

                    <input type="date" name="expiryDate" class="input">

                    <input name="barcode" placeholder="Code-barres" class="input">

                    <input name="batch_number" placeholder="Lot" class="input">

                    <div class="flex items-center gap-4">
                        <label class="flex items-center gap-2 text-sm">
                            <input type="checkbox" name="isNew" class="checkbox">
                            Nouveau
                        </label>

                        <label class="flex items-center gap-2 text-sm">
                            <input type="checkbox" name="requiresPrescription" class="checkbox">
                            Ordonnance
                        </label>
                    </div>

                    <input type="file" name="image" class="input">

                </div>

                {{-- TEXTAREAS --}}
                <div class="mt-6 space-y-3">
                    <textarea name="description" placeholder="Description" class="textarea"></textarea>
                    <textarea name="ingredients" placeholder="Ingrédients" class="textarea"></textarea>
                    <textarea name="usage" placeholder="Utilisation" class="textarea"></textarea>
                    <textarea name="sideEffects" placeholder="Effets secondaires" class="textarea"></textarea>
                    <textarea name="warning" placeholder="Avertissement" class="textarea"></textarea>
                    <textarea name="storage" placeholder="Stockage" class="textarea"></textarea>
                </div>

                <button class="mt-6 bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                    Enregistrer
                </button>

            </form>

        </div>
    </div>
@endsection
