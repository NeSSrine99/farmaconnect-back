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
                            {{-- Replace your card grid section with this --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                                @forelse($products as $product)
                                    <div
                                        class="bg-white rounded-xl border border-gray-100 overflow-hidden flex flex-col hover:-translate-y-0.5 hover:shadow-lg transition-all duration-200">

                                        {{-- Image zone --}}
                                        <div class="relative bg-gray-50 flex items-center justify-center h-40 p-4">
                                            @if ($product->discount > 0)
                                                <span
                                                    class="absolute top-2 left-2 bg-pink-600 text-white text-xs font-bold px-2 py-1 rounded-lg">
                                                    -{{ $product->discount }}%
                                                </span>
                                            @endif
                                            @if ($product->isNew)
                                                <span
                                                    class="absolute top-2 right-9 bg-teal-500 text-white text-xs font-bold px-2 py-1 rounded-lg">
                                                    Nouveau
                                                </span>
                                            @endif
                                            <button
                                                class="absolute top-2 right-2 w-7 h-7 bg-white border border-gray-200 rounded-full flex items-center justify-center text-pink-500 hover:bg-pink-50 transition">♡</button>

                                            @if ($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                    class="max-h-28 max-w-full object-contain">
                                            @else
                                                <div
                                                    class="w-16 h-16 rounded-full bg-teal-500 text-white font-bold text-2xl flex items-center justify-center">
                                                    {{ strtoupper(substr($product->name, 0, 2)) }}
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Body --}}
                                        <div class="p-3 flex flex-col gap-1 flex-1">
                                            <span
                                                class="text-xs bg-gray-100 text-gray-400 rounded px-1.5 py-0.5 self-start">#{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</span>
                                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">
                                                {{ $product->brand }}</p>
                                            <p class="text-sm font-extrabold text-gray-800 leading-tight">
                                                {{ $product->name }}</p>
                                            <div class="flex items-baseline gap-2 mt-1">
                                                @if ($product->price_old)
                                                    <span
                                                        class="text-xs text-gray-400 line-through">{{ $product->price_old }}
                                                        TND</span>
                                                @endif
                                                <span class="text-base font-extrabold text-teal-700">{{ $product->price }}
                                                    TND</span>
                                            </div>
                                            <div class="flex items-center justify-between mt-1">
                                                @if ($product->stock > 0)
                                                    <span
                                                        class="text-xs font-bold bg-green-100 text-green-700 px-2 py-0.5 rounded-full">En
                                                        stock ({{ $product->stock }})</span>
                                                @else
                                                    <span
                                                        class="text-xs font-bold bg-red-100 text-red-600 px-2 py-0.5 rounded-full">Rupture</span>
                                                @endif
                                                @if ($product->requiresPrescription)
                                                    <span
                                                        class="text-xs font-bold bg-amber-50 text-amber-600 px-2 py-0.5 rounded">Rx</span>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Actions --}}
                                        <div class="flex gap-2 p-3 border-t border-gray-50">
                                            <a href="{{ route('admin.products.show', $product->id) }}"
                                                class="flex-1 text-center text-xs font-bold bg-teal-50 text-teal-700 hover:bg-teal-500 hover:text-white py-2 rounded-lg transition">👁
                                                Voir</a>
                                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                                class="text-xs bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white px-3 py-2 rounded-lg transition">✏️</a>
                                            <form action="{{ route('admin.products.destroy', $product->id) }}"
                                                method="POST" onsubmit="return confirm('Supprimer ce produit ?')">
                                                @csrf @method('DELETE')
                                                <button
                                                    class="text-xs bg-red-50 text-red-500 hover:bg-red-500 hover:text-white px-3 py-2 rounded-lg transition">🗑</button>
                                            </form>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-span-full text-center py-16 text-gray-400">Aucun produit trouvé</div>
                                @endforelse
                            </div>

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
