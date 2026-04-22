@extends('admin.layout.layout')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">

    <div class="max-w-3xl mx-auto space-y-6">

        {{-- HEADER --}}
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.products.index') }}"
                   class="bg-white border border-gray-200 text-gray-600 text-sm font-bold px-4 py-2 rounded-lg hover:border-teal-500 hover:text-teal-600 transition">
                    ← Retour
                </a>
                <h1 class="text-xl font-extrabold text-gray-800">Modifier produit</h1>
            </div>

            <form action="{{ route('admin.products.destroy', $product->id) }}"
                  method="POST"
                  onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?')">
                @csrf
                @method('DELETE')

                <button class="bg-red-50 border border-red-200 text-red-600 text-sm font-bold px-4 py-2 rounded-lg hover:bg-red-600 hover:text-white transition">
                    Supprimer
                </button>
            </form>
        </div>

        {{-- ERRORS --}}
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-600 rounded-lg p-4 text-sm font-semibold">
                @foreach ($errors->all() as $error)
                    <div>• {{ $error }}</div>
                @endforeach
            </div>
        @endif

        {{-- FORM --}}
        <form action="{{ route('admin.products.update', $product->id) }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-5">

            @csrf
            @method('PUT')

            {{-- GENERAL --}}
            <div class="bg-white rounded-xl border border-gray-100 p-5 space-y-4">
                <h2 class="text-xs font-extrabold uppercase text-teal-700 border-b pb-2">
                    Informations générales
                </h2>

                <input name="name"
                       value="{{ $product->name }}"
                       class="w-full border rounded-lg px-3 py-2 text-sm"
                       placeholder="Nom du produit">

                <input name="brand"
                       value="{{ $product->brand }}"
                       class="w-full border rounded-lg px-3 py-2 text-sm"
                       placeholder="Marque">

                <textarea name="description"
                          class="w-full border rounded-lg px-3 py-2 text-sm"
                          placeholder="Description">{{ $product->description }}</textarea>

                <select name="category_id"
                        class="w-full border rounded-lg px-3 py-2 text-sm">
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}"
                            {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- PRICE --}}
            <div class="bg-white rounded-xl border border-gray-100 p-5 space-y-4">
                <h2 class="text-xs font-extrabold uppercase text-teal-700 border-b pb-2">
                    Prix & Stock
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <input name="price"
                           type="number"
                           step="0.01"
                           value="{{ $product->price }}"
                           class="w-full border rounded-lg px-3 py-2 text-sm"
                           placeholder="Prix">

                    <input name="discount"
                           type="number"
                           step="0.01"
                           value="{{ $product->discount }}"
                           class="w-full border rounded-lg px-3 py-2 text-sm"
                           placeholder="Remise">

                    <input name="stock"
                           type="number"
                           value="{{ $product->stock }}"
                           class="w-full border rounded-lg px-3 py-2 text-sm"
                           placeholder="Stock">
                </div>

                <select name="availability"
                        class="w-full border rounded-lg px-3 py-2 text-sm">
                    <option value="in stock" {{ $product->availability == 'in stock' ? 'selected' : '' }}>
                        En stock
                    </option>
                    <option value="out of stock" {{ $product->availability == 'out of stock' ? 'selected' : '' }}>
                        Rupture
                    </option>
                </select>
            </div>

            {{-- IMAGE (SAME AS CREATE) --}}
            <div class="bg-white rounded-xl border border-gray-100 p-5">
                <h2 class="text-xs font-extrabold uppercase text-teal-700 border-b pb-2 mb-4">
                    Image produit
                </h2>

                <div id="dropZone"
                     class="relative border-2 border-dashed border-gray-300 rounded-xl p-6 text-center cursor-pointer hover:border-teal-400 transition flex flex-col items-center justify-center">

                    {{-- PLACEHOLDER --}}
                    <div id="placeholder" class="{{ $product->image ? 'hidden' : '' }} flex flex-col items-center gap-2">
                        <div class="text-4xl text-gray-400">📷</div>
                        <p class="text-sm text-gray-500 font-semibold">Glisser image ou cliquer</p>
                    </div>

                    {{-- PREVIEW --}}
                    <img id="previewImage"
                         src="{{ $product->image ? asset('storage/'.$product->image) : '' }}"
                         class="{{ $product->image ? '' : 'hidden' }} max-h-64 rounded-lg object-contain">

                    <input type="file" name="image" id="imageInput" class="hidden">
                </div>

                <div id="imageInfo" class="hidden mt-3 text-xs text-gray-500 text-center"></div>

                <div class="mt-3 hidden text-center" id="cropActions">
                    <button type="button" onclick="cropImage()"
                            class="bg-teal-600 text-white px-4 py-2 rounded-lg text-sm">
                        Crop
                    </button>

                    <button type="button" onclick="resetImage()"
                            class="ml-2 bg-gray-200 px-4 py-2 rounded-lg text-sm">
                        Supprimer
                    </button>
                </div>
            </div>

            {{-- OPTIONS --}}
            <div class="bg-white rounded-xl border border-gray-100 p-5 space-y-3">
                <h2 class="text-xs font-extrabold uppercase text-teal-700 border-b pb-2">
                    Options
                </h2>

                <label class="flex items-center gap-2">
                    <input type="checkbox" name="isNew" {{ $product->isNew ? 'checked' : '' }}>
                    Nouveau produit
                </label>

                <label class="flex items-center gap-2">
                    <input type="checkbox" name="requiresPrescription" {{ $product->requiresPrescription ? 'checked' : '' }}>
                    Ordonnance
                </label>
            </div>

            {{-- SUBMIT --}}
            <div class="flex justify-end">
                <button type="submit"
                        class="bg-teal-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-teal-700">
                    Mettre à jour
                </button>
            </div>

        </form>
    </div>
</div>

{{-- SCRIPT (SAME AS CREATE + SAFE EDIT SUPPORT) --}}
<script>
let cropper;

const input = document.getElementById('imageInput');
const dropZone = document.getElementById('dropZone');
const preview = document.getElementById('previewImage');
const placeholder = document.getElementById('placeholder');
const info = document.getElementById('imageInfo');
const actions = document.getElementById('cropActions');

// CLICK
dropZone.addEventListener('click', () => input.click());

// DROP
dropZone.addEventListener('dragover', e => {
    e.preventDefault();
    dropZone.classList.add('border-teal-500');
});

dropZone.addEventListener('dragleave', () => {
    dropZone.classList.remove('border-teal-500');
});

dropZone.addEventListener('drop', e => {
    e.preventDefault();
    input.files = e.dataTransfer.files;
    showImage(e.dataTransfer.files[0]);
});

// INPUT
input.addEventListener('change', function () {
    if (this.files[0]) showImage(this.files[0]);
});

function showImage(file) {
    const url = URL.createObjectURL(file);

    preview.onload = () => {
        if (cropper) cropper.destroy();

        cropper = new Cropper(preview, {
            aspectRatio: 1,
            viewMode: 1,
        });
    };

    preview.src = url;

    placeholder.classList.add('hidden');
    preview.classList.remove('hidden');
    actions.classList.remove('hidden');
    info.classList.remove('hidden');

    info.innerHTML = `
        <strong>${file.name}</strong><br>
        ${(file.size / 1024).toFixed(1)} KB
    `;
}

function cropImage() {
    if (!cropper) return;

    const canvas = cropper.getCroppedCanvas({
        width: 500,
        height: 500,
    });

    canvas.toBlob(blob => {
        const file = new File([blob], "cropped.png", { type: "image/png" });

        const dt = new DataTransfer();
        dt.items.add(file);
        input.files = dt.files;

        showImage(file);
    });
}

function resetImage() {
    input.value = "";
    preview.src = "";

    if (cropper) cropper.destroy();

    preview.classList.add('hidden');
    placeholder.classList.remove('hidden');
    actions.classList.add('hidden');
    info.classList.add('hidden');
}
</script>
@endsection