@extends('admin.layout.layout')

@section('header', 'Gestion des Produits')

@section('content')

    <div class="med-page">

        {{-- ALERT --}}
        @if (session('success'))
            <div class="med-alert">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <polyline points="20 6 9 12 4 10" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- PAGE HEADER --}}
        <div class="med-header">
            <div class="med-header__left">
                <div class="med-header__icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 01-2.83 0L2 12V2h10l8.59 8.59a2 2 0 010 2.82z" />
                        <line x1="7" y1="7" x2="7.01" y2="7" />
                    </svg>
                </div>
                <div>
                    <h1 class="med-header__title">Gestion des Produits</h1>
                    <p class="med-header__sub">{{ $products->count() }} produits trouvés</p>
                </div>
            </div>
            <a href="{{ route('admin.products.create') }}" class="med-btn-primary">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5"
                    viewBox="0 0 24 24">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Ajouter un produit
            </a>
        </div>

        {{-- FILTERS --}}
        <div class="med-filters">

            <div class="med-field">
                <svg class="med-field__ico" width="13" height="13" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8" />
                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                </svg>
                <input type="text" placeholder="Rechercher un produit..." class="med-input" style="width:210px;">
            </div>

            <div class="med-field">
                <svg class="med-field__ico" width="13" height="13" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path d="M22 19a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h5l2 3h9a2 2 0 012 2z" />
                </svg>
                <select class="med-input" style="width:160px;">
                    <option>Toutes catégories</option>
                    <option>Médicaments</option>
                    <option>Vitamines</option>
                    <option>Cosmétiques</option>
                    <option>Matériel médical</option>
                </select>
            </div>

            <div class="med-field">
                <svg class="med-field__ico" width="13" height="13" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path
                        d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z" />
                </svg>
                <select class="med-input" style="width:140px;">
                    <option>Tout stock</option>
                    <option>En stock</option>
                    <option>Rupture</option>
                </select>
            </div>

            <div class="med-pills">
                <button class="med-pill med-pill--promo">💸 Promo</button>
                <button class="med-pill med-pill--new">✨ Nouveau</button>
                <button class="med-pill med-pill--rx">💊 Ordonnance</button>
            </div>

        </div>

        {{-- PRODUCT GRID --}}
        <div class="med-grid">

            @forelse($products as $product)
                <div class="med-card">

                    {{-- IMAGE --}}
                    <div class="med-card__img">

                        @if ($product->discount > 0)
                            <span class="med-badge med-badge--discount">-{{ $product->discount }}%</span>
                        @endif

                        @if ($product->isNew)
                            <span class="med-badge med-badge--new">Nouveau</span>
                        @endif

                        @if ($product->requiresPrescription)
                            <span class="med-badge med-badge--rx">Rx</span>
                        @endif

                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="med-card__photo">
                        @else
                            <div class="med-card__avatar">
                                {{ strtoupper(substr($product->name, 0, 2)) }}
                            </div>
                        @endif

                    </div>

                    {{-- BODY --}}
                    <div class="med-card__body">

                        <div class="med-card__meta">
                            <span class="med-card__id">#{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</span>
                            @if ($product->stock > 0)
                                <span class="med-status med-status--in">● En stock</span>
                            @else
                                <span class="med-status med-status--out">● Rupture</span>
                            @endif
                        </div>

                        <p class="med-card__brand">{{ $product->brand }}</p>
                        <h3 class="med-card__name">{{ $product->name }}</h3>

                        <div class="med-card__prices">
                            @if ($product->price_old)
                                <span class="med-card__price-old">{{ $product->price_old }} TND</span>
                            @endif
                            <span class="med-card__price">{{ $product->price }} TND</span>
                        </div>

                        <div class="med-card__stock-count">
                            <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path
                                    d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z" />
                            </svg>
                            {{ $product->stock }} unités
                        </div>

                    </div>

                    {{-- ADMIN ACTIONS --}}
                    <div class="med-card__actions">

                        <a href="{{ route('admin.products.show', $product->id) }}" class="med-action med-action--view">
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            Voir
                        </a>

                        <a href="{{ route('admin.products.edit', $product->id) }}" class="med-action med-action--edit">
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                                <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                            </svg>
                            Modifier
                        </a>

                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                            onsubmit="return confirm('Supprimer « {{ addslashes($product->name) }} » ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="med-action med-action--delete" title="Supprimer">
                                <svg width="13" height="13" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <polyline points="3 6 5 6 21 6" />
                                    <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6" />
                                    <path d="M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2" />
                                </svg>
                            </button>
                        </form>

                    </div>

                </div>

            @empty
                <div class="med-empty">
                    <svg width="44" height="44" fill="none" stroke="currentColor" stroke-width="1.5"
                        viewBox="0 0 24 24">
                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 01-2.83 0L2 12V2h10l8.59 8.59a2 2 0 010 2.82z" />
                        <line x1="7" y1="7" x2="7.01" y2="7" />
                    </svg>
                    <p>Aucun produit trouvé</p>
                    <a href="{{ route('admin.products.create') }}" class="med-btn-primary"
                        style="margin-top:14px;display:inline-flex;">
                        + Ajouter le premier produit
                    </a>
                </div>
            @endforelse

        </div>

        {{-- PAGINATION --}}
        @if ($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="med-pagination">
                <span class="med-pagination__info">
                    {{ $products->firstItem() }}–{{ $products->lastItem() }} sur {{ $products->total() }} produits
                </span>
                <div class="med-pagination__pages">

                    @if ($products->onFirstPage())
                        <span class="med-page-btn med-page-btn--disabled">←</span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" class="med-page-btn">←</a>
                    @endif

                    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                        <a href="{{ $url }}"
                            class="med-page-btn {{ $page == $products->currentPage() ? 'med-page-btn--active' : '' }}">
                            {{ $page }}
                        </a>
                    @endforeach

                    @if ($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" class="med-page-btn">→</a>
                    @else
                        <span class="med-page-btn med-page-btn--disabled">→</span>
                    @endif

                </div>
            </div>
        @endif

    </div>

    <style>
        :root {
            --teal-50: #E1F5EE;
            --teal-100: #9FE1CB;
            --teal-500: #1D9E75;
            --teal-700: #0F6E56;
            --blue-50: #E6F1FB;
            --blue-500: #378ADD;
            --blue-700: #185FA5;
            --pink-50: #FBEAF0;
            --pink-400: #D4537E;
            --pink-700: #993556;
            --amber-50: #FAEEDA;
            --amber-400: #BA7517;
            --amber-500: #EF9F27;
            --green-50: #EAF3DE;
            --green-700: #3B6D11;
            --red-50: #FCEBEB;
            --red-500: #E24B4A;
            --red-700: #A32D2D;
            --gray-50: #F8F9FA;
            --gray-100: #F1F3F4;
            --gray-200: #E8EAED;
            --gray-400: #9AA0A6;
            --gray-600: #5F6368;
            --gray-800: #3C4043;
            --gray-900: #202124;
        }

        .med-page {
            padding: 28px;
            background: var(--color-white);
            min-height: 100vh;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        .med-alert {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--green-50);
            color: var(--green-700);
            border: 1px solid #c0dd97;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 13.5px;
            font-weight: 500;
            margin-bottom: 22px;
        }

        .med-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .med-header__left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .med-header__icon {
            width: 42px;
            height: 42px;
            background: var(--teal-50);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--teal-500);
        }

        .med-header__title {
            font-size: 21px;
            font-weight: 600;
            color: var(--gray-900);
            letter-spacing: -0.3px;
        }

        .med-header__sub {
            font-size: 12px;
            color: var(--gray-400);
            margin-top: 2px;
        }

        .med-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--teal-500);
            color: white;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: background .18s;
            white-space: nowrap;
        }

        .med-btn-primary:hover {
            background: var(--teal-700);
            color: white;
        }

        .med-filters {
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: 12px;
            padding: 13px 16px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .05);
        }

        .med-field {
            position: relative;
            display: flex;
            align-items: center;
        }

        .med-field__ico {
            position: absolute;
            left: 10px;
            color: var(--gray-400);
            pointer-events: none;
        }

        .med-input {
            height: 34px;
            padding: 0 11px 0 30px;
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            font-size: 13px;
            color: var(--gray-800);
            background: var(--gray-50);
            outline: none;
            transition: border-color .15s, box-shadow .15s;
            -webkit-appearance: none;
        }

        .med-input:focus {
            border-color: var(--teal-100);
            box-shadow: 0 0 0 3px rgba(29, 158, 117, .1);
            background: white;
        }

        .med-pills {
            display: flex;
            gap: 7px;
            margin-left: auto;
            flex-wrap: wrap;
        }

        .med-pill {
            padding: 5px 13px;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 600;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all .18s;
            white-space: nowrap;
            background: none;
        }

        .med-pill--promo {
            background: var(--teal-50);
            color: var(--teal-700);
            border-color: var(--teal-100);
        }

        .med-pill--promo:hover {
            background: var(--teal-500);
            color: white;
        }

        .med-pill--new {
            background: var(--pink-50);
            color: var(--pink-700);
            border-color: #f4c0d1;
        }

        .med-pill--new:hover {
            background: var(--pink-400);
            color: white;
        }

        .med-pill--rx {
            background: var(--amber-50);
            color: var(--amber-400);
            border-color: #fac775;
        }

        .med-pill--rx:hover {
            background: var(--amber-500);
            color: white;
        }

        .med-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(215px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .med-card {
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: 14px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .05);
            transition: box-shadow .2s, transform .2s, border-color .2s;
        }

        .med-card:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, .09);
            transform: translateY(-2px);
            border-color: var(--teal-100);
        }

        .med-card__img {
            position: relative;
            background: var(--gray-50);
            height: 145px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
            border-bottom: 1px solid var(--gray-100);
        }

        .med-card__photo {
            max-height: 108px;
            max-width: 100%;
            object-fit: contain;
        }

        .med-card__avatar {
            width: 58px;
            height: 58px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--teal-500), var(--teal-700));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .med-badge {
            position: absolute;
            font-size: 10px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 5px;
            letter-spacing: .03em;
            top: 9px;
        }

        .med-badge--discount {
            left: 9px;
            background: var(--pink-400);
            color: white;
        }

        .med-badge--new {
            left: 9px;
            background: var(--teal-500);
            color: white;
            top: 34px;
        }

        .med-badge--rx {
            right: 9px;
            background: var(--amber-50);
            color: var(--amber-400);
            border: 1px solid #fac775;
        }

        .med-card__body {
            padding: 12px 14px;
            display: flex;
            flex-direction: column;
            gap: 4px;
            flex: 1;
        }

        .med-card__meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2px;
        }

        .med-card__id {
            font-size: 10px;
            background: var(--gray-100);
            color: var(--gray-600);
            padding: 2px 7px;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
            letter-spacing: .04em;
        }

        .med-status {
            font-size: 10.5px;
            font-weight: 600;
        }

        .med-status--in {
            color: var(--green-700);
        }

        .med-status--out {
            color: var(--red-700);
        }

        .med-card__brand {
            font-size: 10.5px;
            color: var(--gray-400);
            text-transform: uppercase;
            letter-spacing: .08em;
            font-weight: 500;
        }

        .med-card__name {
            font-size: 13.5px;
            font-weight: 600;
            color: var(--gray-900);
            line-height: 1.3;
        }

        .med-card__prices {
            display: flex;
            align-items: center;
            gap: 7px;
            margin-top: 2px;
        }

        .med-card__price-old {
            font-size: 11px;
            text-decoration: line-through;
            color: var(--gray-400);
        }

        .med-card__price {
            font-size: 15px;
            font-weight: 700;
            color: var(--teal-700);
        }

        .med-card__stock-count {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            color: var(--gray-400);
            margin-top: 2px;
        }

        .med-card__actions {
            display: flex;
            gap: 6px;
            padding: 10px 12px;
            border-top: 1px solid var(--gray-100);
            background: var(--gray-50);
        }

        .med-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            padding: 7px 10px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: all .17s;
            white-space: nowrap;
        }

        .med-action--view {
            flex: 1;
            background: var(--teal-50);
            color: var(--teal-700);
        }

        .med-action--view:hover {
            background: var(--teal-500);
            color: white;
        }

        .med-action--edit {
            background: var(--blue-50);
            color: var(--blue-700);
            padding: 7px 12px;
        }

        .med-action--edit:hover {
            background: var(--blue-500);
            color: white;
        }

        .med-action--delete {
            background: var(--red-50);
            color: var(--red-700);
            padding: 7px 12px;
        }

        .med-action--delete:hover {
            background: var(--red-500);
            color: white;
        }

        .med-empty {
            grid-column: 1/-1;
            text-align: center;
            color: var(--gray-400);
            padding: 60px 20px;
            font-size: 14px;
        }

        .med-empty svg {
            margin: 0 auto 12px;
            display: block;
            opacity: .35;
        }

        .med-pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 2px 0;
            flex-wrap: wrap;
            gap: 10px;
        }

        .med-pagination__info {
            font-size: 12.5px;
            color: var(--gray-400);
        }

        .med-pagination__pages {
            display: flex;
            gap: 5px;
        }

        .med-page-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border: 1px solid var(--gray-200);
            border-radius: 7px;
            font-size: 13px;
            color: var(--gray-600);
            background: white;
            text-decoration: none;
            transition: all .15s;
            cursor: pointer;
        }

        .med-page-btn:hover {
            background: var(--gray-100);
            border-color: var(--gray-400);
            color: var(--gray-900);
        }

        .med-page-btn--active {
            background: var(--teal-500);
            color: white;
            border-color: var(--teal-500);
            font-weight: 600;
        }

        .med-page-btn--active:hover {
            background: var(--teal-700);
            border-color: var(--teal-700);
            color: white;
        }

        .med-page-btn--disabled {
            opacity: .3;
            cursor: not-allowed;
            pointer-events: none;
        }

        @media (max-width:640px) {
            .med-page {
                padding: 14px;
            }

            .med-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .med-filters {
                flex-direction: column;
                align-items: stretch;
            }

            .med-pills {
                margin-left: 0;
            }

            .med-grid {
                grid-template-columns: 1fr 1fr;
                gap: 12px;
            }
        }

        @media (max-width:420px) {
            .med-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

@endsection
