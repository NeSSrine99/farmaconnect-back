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
                class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow hover:bg-indigo-700 transition">
                + Ajouter Produit
            </a>
        </div>

        {{-- TABLE CARD --}}
        <div class="bg-white rounded-xl shadow overflow-hidden">

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">

                    {{-- HEAD --}}
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3">#ID</th>
                            <th class="px-4 py-3">Produit</th>
                            <th class="px-4 py-3">Prix</th>
                            <th class="px-4 py-3">Stock</th>
                            <th class="px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>

                    {{-- BODY --}}
                    <tbody class="divide-y">

                        @forelse($products as $product)
                            <tr class="hover:bg-gray-50 transition">

                                {{-- ID --}}
                                <td class="px-4 py-3">
                                    <span class="text-xs bg-gray-100 px-2 py-1 rounded">
                                        #{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>

                                {{-- PRODUCT --}}
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">

                                        @if ($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}"
                                                class="w-10 h-10 rounded-full object-cover">
                                        @else
                                            <div
                                                class="w-10 h-10 flex items-center justify-center rounded-full bg-indigo-500 text-white font-bold">
                                                {{ strtoupper(substr($product->name, 0, 1)) }}
                                            </div>
                                        @endif

                                        <span class="font-semibold text-gray-800">
                                            {{ $product->name }}
                                        </span>
                                    </div>
                                </td>

                                {{-- PRICE --}}
                                <td class="px-4 py-3 font-semibold text-blue-600">
                                    {{ $product->price }} DT
                                </td>

                                {{-- STOCK --}}
                                <td class="px-4 py-3">
                                    @if ($product->stock > 0)
                                        <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                            En stock ({{ $product->stock }})
                                        </span>
                                    @else
                                        <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-600">
                                            Rupture
                                        </span>
                                    @endif
                                </td>

                                {{-- ACTIONS --}}
                                <td class="px-4 py-3">
                                    <div class="flex justify-center gap-2">

                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                            class="px-3 py-1 text-sm bg-blue-100 text-blue-600 rounded hover:bg-blue-600 hover:text-white transition">
                                            ✏️
                                        </a>

                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                            onsubmit="return confirm('Supprimer ce produit ?');">
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                class="px-3 py-1 text-sm bg-red-100 text-red-600 rounded hover:bg-red-600 hover:text-white transition">
                                                🗑
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-10 text-gray-400">
                                    Aucun produit trouvé
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
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
