@extends('admin.layout.layout')

@section('header', 'Gestion des Produits')

@section('content')

    <div class="p-6 bg-gray-100 min-h-screen">

        {{-- ALERT --}}
        @if (session('success'))
            <div class="mb-6 p-4 rounded-lg bg-green-50 text-green-700 border border-green-200">
                ✔ {{ session('success') }}
            </div>
        @endif

        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Produits</h1>
                <p class="text-sm text-gray-500">{{ $products->count() }} produits trouvés</p>
            </div>

            <a href="{{ route('admin.products.create') }}"
                class="bg-teal-500 text-white  p-3 text-sm  rounded-lg shadow hover:bg-teal-600 transition">
                + Ajouter Produit
            </a>
        </div>

        {{-- TABLE CARD --}}
        <div class="bg-white rounded-xl shadow overflow-hidden">
            <div class="bg-white p-4 rounded-xl mb-5 flex flex-wrap gap-3 items-center border">

                {{-- SEARCH --}}
                <div class="relative w-60">
                    <span class="absolute left-3 top-2.5 text-gray-400 text-sm">🔍</span>
                    <input type="text" placeholder="Rechercher..."
                        class="w-full border pl-9 pr-3 py-2 rounded-lg text-sm focus:ring-2 focus:ring-teal-500 outline-none">
                </div>

                {{-- CATEGORY --}}
                <div class="relative">
                    <span class="absolute left-3 top-2.5 text-gray-400 text-sm">📂</span>
                    <select class="border pl-9 pr-3 py-2 rounded-lg text-sm focus:ring-2 focus:ring-teal-500">
                        <option>Toutes catégories</option>
                    </select>
                </div>

                {{-- STOCK --}}
                <div class="relative">
                    <span class="absolute left-3 top-2.5 text-gray-400 text-sm">📦</span>
                    <select class="border pl-9 pr-3 py-2 rounded-lg text-sm focus:ring-2 focus:ring-teal-500">
                        <option>Tout stock</option>
                        <option>En stock</option>
                        <option>Rupture</option>
                    </select>
                </div>

                {{-- FILTER BUTTONS --}}
                <div class="flex gap-2 ml-auto flex-wrap">

                    <button
                        class="flex items-center gap-1  bg-teal-50 text-teal-700 px-3 py-1.5 rounded-full text-xs font-bold hover:bg-teal-600 hover:text-white transition">
                        💸 Promo
                    </button>

                    <button
                        class="flex items-center gap-1 bg-pink-50 text-pink-600 px-3 py-1.5 rounded-full text-xs font-bold hover:bg-pink-600 hover:text-white transition">
                        ✨ Nouveau
                    </button>

                    <button
                        class="flex items-center gap-1 bg-amber-50 text-amber-600 px-3 py-1.5 rounded-full text-xs font-bold hover:bg-amber-500 hover:text-white transition">
                        💊 Ordonnance
                    </button>

                </div>

            </div>

            <div class="overflow-x-auto">
                {{-- PRODUCTS GRID --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5">

                    @forelse($products as $product)
                        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition">

                            {{-- IMAGE --}}
                            <div class="relative bg-gray-50 h-40 flex items-center justify-center p-4">

                                @if ($product->discount > 0)
                                    <span class="absolute top-2 left-2 bg-pink-600 text-white text-xs px-2 py-1 rounded">
                                        -{{ $product->discount }}%
                                    </span>
                                @endif

                                @if ($product->isNew)
                                    <span class="absolute top-2 right-10 bg-teal-500 text-white text-xs px-2 py-1 rounded">
                                        Nouveau
                                    </span>
                                @endif

                                <button class="absolute top-2 right-2 bg-white border rounded-full w-7 h-7 text-pink-500">
                                    ♡
                                </button>

                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="max-h-28 object-contain">
                                @else
                                    <div
                                        class="w-16 h-16 bg-teal-500 text-white flex items-center justify-center rounded-full text-xl font-bold">
                                        {{ strtoupper(substr($product->name, 0, 2)) }}
                                    </div>
                                @endif
                            </div>

                            {{-- BODY --}}
                            <div class="p-3 flex flex-col gap-1">

                                <span class="text-xs bg-gray-100 px-2 py-0.5 rounded w-fit">
                                    #{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}
                                </span>

                                <p class="text-xs text-gray-400 uppercase">{{ $product->brand }}</p>

                                <h3 class="text-sm font-bold text-gray-800">
                                    {{ $product->name }}
                                </h3>

                                {{-- PRICE --}}
                                <div class="flex gap-2 items-center">
                                    @if ($product->price_old)
                                        <span class="text-xs line-through text-gray-400">
                                            {{ $product->price_old }} TND
                                        </span>
                                    @endif

                                    <span class="text-teal-700 font-bold">
                                        {{ $product->price }} TND
                                    </span>
                                </div>

                                {{-- STOCK --}}
                                <div class="flex justify-between items-center mt-1">
                                    @if ($product->stock > 0)
                                        <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">
                                            En stock ({{ $product->stock }})
                                        </span>
                                    @else
                                        <span class="text-xs bg-red-100 text-red-600 px-2 py-1 rounded-full">
                                            Rupture
                                        </span>
                                    @endif

                                    @if ($product->requiresPrescription)
                                        <span class="text-xs bg-amber-50 text-amber-600 px-2 py-1 rounded">
                                            Rx
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- ACTIONS --}}
                            <div class="flex gap-2 p-3 border-t">

                                <a href="{{ route('admin.products.show', $product->id) }}"
                                    class="flex-1 text-center text-xs bg-teal-50 text-teal-700 py-2 rounded hover:bg-teal-600 hover:text-white">
                                    👁 Voir
                                </a>

                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                    class="bg-blue-50 text-blue-600 px-3 py-2 rounded hover:bg-blue-600 hover:text-white">
                                    ✏️
                                </a>

                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button
                                        class="bg-red-50 text-red-500 px-3 py-2 rounded hover:bg-red-500 hover:text-white">
                                        🗑
                                    </button>
                                </form>

                            </div>

                        </div>
                    @empty
                        <div class="col-span-full text-center text-gray-400 py-10">
                            Aucun produit trouvé
                        </div>
                    @endforelse

                </div>
            </div>

            {{-- PAGINATION --}}
            @if ($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="flex justify-between items-center p-4 border-t text-sm text-gray-500 flex-wrap gap-3">

                    <span>
                        {{ $products->firstItem() }}–{{ $products->lastItem() }}
                        sur {{ $products->total() }}
                    </span>

                    <div class="flex gap-1">

                        {{-- PREV --}}
                        @if ($products->onFirstPage())
                            <span class="px-3 py-1 border rounded opacity-40">←</span>
                        @else
                            <a href="{{ $products->previousPageUrl() }}"
                                class="px-3 py-1 border rounded hover:bg-gray-100">←</a>
                        @endif

                        {{-- PAGES --}}
                        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                            <a href="{{ $url }}"
                                class="px-3 py-1 border rounded {{ $page == $products->currentPage() ? 'bg-indigo-600 text-white border-indigo-600' : 'hover:bg-gray-100' }}">
                                {{ $page }}
                            </a>
                        @endforeach

                        {{-- NEXT --}}
                        @if ($products->hasMorePages())
                            <a href="{{ $products->nextPageUrl() }}"
                                class="px-3 py-1 border rounded hover:bg-gray-100">→</a>
                        @else
                            <span class="px-3 py-1 border rounded opacity-40">→</span>
                        @endif

                    </div>
                </div>
            @endif

        </div>

    </div>

@endsection
