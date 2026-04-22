@extends('admin.layout.layout')
@section('content')
    <div class="p-6 bg-gray-100 min-h-screen">
        <div class="max-w-3xl mx-auto space-y-5">

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.products.index') }}"
                    class="bg-white border border-gray-200 text-gray-500 text-sm font-bold px-4 py-2 rounded-lg hover:border-teal-500 hover:text-teal-600 transition">←
                    Retour</a>
                <h1 class="text-xl font-extrabold text-gray-800">Ajouter un produit</h1>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 text-red-600 border border-red-200 rounded-lg p-4 text-sm font-semibold">
                    @foreach ($errors->all() as $e)
                        <div>• {{ $e }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                {{-- Informations générales --}}
                <div class="bg-white rounded-xl border border-gray-100 p-5">
                    <h2
                        class="text-xs font-extrabold uppercase tracking-widest text-teal-700 border-b-2 border-teal-50 pb-2 mb-4">
                        Informations générales</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold text-gray-500 mb-1 block">Nom du produit <span
                                    class="text-red-500">*</span></label>
                            <input name="name" type="text" placeholder="ex. Cetaphil Sun SPF 50+"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-teal-500 outline-none"
                                required>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-500 mb-1 block">Marque <span
                                    class="text-red-500">*</span></label>
                            <input name="brand" type="text" placeholder="ex. Cetaphil"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-teal-500 outline-none"
                                required>
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-xs font-bold text-gray-500 mb-1 block">Description</label>
                            <textarea name="description" rows="3" placeholder="Description, ingrédients, mode d'emploi..."
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-teal-500 outline-none resize-y"></textarea>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-500 mb-1 block">Catégorie <span
                                    class="text-red-500">*</span></label>
                            <select name="category_id"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-teal-500 outline-none"
                                required>
                                <option value="">Sélectionner...</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-500 mb-1 block">Référence / SKU</label>
                            <input name="sku" type="text" placeholder="ex. CTF-SUN-50"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-teal-500 outline-none">
                        </div>
                    </div>
                </div>

                {{-- Prix & Stock --}}
                <div class="bg-white rounded-xl border border-gray-100 p-5">
                    <h2
                        class="text-xs font-extrabold uppercase tracking-widest text-teal-700 border-b-2 border-teal-50 pb-2 mb-4">
                        Prix & Stock</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <div>
                            <label class="text-xs font-bold text-gray-500 mb-1 block">Prix (TND) <span
                                    class="text-red-500">*</span></label>
                            <input name="price" type="number" step="0.01" min="0" placeholder="0.00"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-teal-500 outline-none"
                                required>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-500 mb-1 block">Ancien prix (TND)</label>
                            <input name="price_old" type="number" step="0.01" min="0" placeholder="0.00"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-teal-500 outline-none">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-500 mb-1 block">Remise (%)</label>
                            <input name="discount" type="number" min="0" max="100" placeholder="0"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-teal-500 outline-none">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-500 mb-1 block">Stock</label>
                            <input name="stock" type="number" min="0" placeholder="0"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-teal-500 outline-none">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-500 mb-1 block">Disponibilité</label>
                            <select name="availability"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-teal-500 outline-none">
                                <option value="in stock">En stock</option>
                                <option value="out of stock">Rupture</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Image --}}
                <div class="bg-white rounded-xl border border-gray-100 p-5">
                    <h2 class="text-xs font-extrabold uppercase text-teal-700 border-b-2 border-teal-50 pb-2 mb-4">
                        Image produit
                    </h2>

                    {{-- DROP ZONE --}}
                    <div id="dropZone"
                        class="relative border-2 border-dashed border-gray-300 rounded-xl p-6 text-center cursor-pointer hover:border-teal-400 transition flex flex-col items-center justify-center">

                        {{-- ICON + TEXT --}}
                        <div id="placeholder" class="flex flex-col items-center gap-2">
                            <div class="text-4xl text-gray-400">📷</div>
                            <p class="text-sm text-gray-500 font-semibold">
                                Glisser image ici ou cliquer
                            </p>
                            <p class="text-xs text-gray-400">
                                PNG, JPG (max 2MB)
                            </p>
                        </div>

                        {{-- IMAGE PREVIEW --}}
                        <img id="previewImage" class="hidden max-h-64 rounded-lg object-contain">

                        <input type="file" name="image" id="imageInput" accept="image/*" class="hidden">
                    </div>

                    {{-- IMAGE INFO --}}
                    <div id="imageInfo" class="hidden mt-3 text-xs text-gray-500 text-center"></div>

                    {{-- ACTIONS --}}
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

                {{-- Options --}}
                <div class="bg-white rounded-xl border border-gray-100 p-5">
                    <h2
                        class="text-xs font-extrabold uppercase tracking-widest text-teal-700 border-b-2 border-teal-50 pb-2 mb-4">
                        Options</h2>
                    <div class="grid grid-cols-2 gap-3">
                        @foreach ([['isNew', 'Nouveau produit'], ['requiresPrescription', 'Ordonnance requise'], ['isFeatured', 'Mise en avant'], ['isBestSeller', 'Best Seller']] as [$n, $l])
                            <label
                                class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 cursor-pointer hover:border-teal-400 transition">
                                <input type="checkbox" name="{{ $n }}" class="accent-teal-600 w-4 h-4">
                                <span class="text-sm font-bold text-gray-700">{{ $l }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.products.index') }}"
                        class="bg-white border border-gray-200 text-gray-500 text-sm font-bold px-5 py-2.5 rounded-lg hover:border-red-400 hover:text-red-500 transition">Annuler</a>
                    <button type="submit"
                        class="bg-teal-600 hover:bg-teal-700 text-white text-sm font-extrabold px-6 py-2.5 rounded-lg transition">Enregistrer
                        le produit</button>
                </div>

            </form>
        </div>
    </div>
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

        // DRAG
        dropZone.addEventListener('dragover', e => {
            e.preventDefault();
            dropZone.classList.add('border-teal-500');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('border-teal-500');
        });

        dropZone.addEventListener('drop', e => {
            e.preventDefault();
            dropZone.classList.remove('border-teal-500');

            const file = e.dataTransfer.files[0];
            input.files = e.dataTransfer.files;

            showImage(file);
        });

        // INPUT
        input.addEventListener('change', function() {
            const file = this.files[0];
            if (file) showImage(file);
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

            // UI CHANGE
            placeholder.classList.add('hidden');
            preview.classList.remove('hidden');
            actions.classList.remove('hidden');
            info.classList.remove('hidden');

            // INFO
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
                const file = new File([blob], "cropped.png", {
                    type: "image/png"
                });

                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                input.files = dataTransfer.files;

                showImage(file);
            });
        }

        function resetImage() {
            input.value = "";
            preview.src = "";

            if (cropper) cropper.destroy();

            // UI RESET
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
            actions.classList.add('hidden');
            info.classList.add('hidden');
        }
    </script>
@endsection
