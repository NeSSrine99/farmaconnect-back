@extends('admin.layout.layout')

@section('content')
    <div class="p-6 max-w-5xl mx-auto">

        <h1 class="text-2xl font-bold mb-6">
            Create Order from Prescription #{{ $prescription->id }}
        </h1>

        <!-- USER -->
        <div class="bg-white p-4 rounded shadow mb-6">
            <p><strong>User:</strong> {{ $prescription->user->name }}</p>
            <p><strong>Email:</strong> {{ $prescription->user->email }}</p>
        </div>

        <!-- PRESCRIPTION IMAGE -->
        <div class="bg-white p-4 rounded shadow mb-6 text-center">
            <img src="{{ asset('storage/' . $prescription->file) }}" class="max-h-80 mx-auto rounded">
        </div>

        <!-- FORM -->
        <form method="POST" action="{{ route('admin.prescriptions.storeOrder', $prescription->id) }}">
            @csrf

            <div id="products-container" class="space-y-4">

                <!-- PRODUCT ROW -->
                <div class="flex gap-3">
                    <select name="products[0][product_id]" class="border p-2 rounded w-full">
                        <option value="">Select product</option>

                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">
                                {{ $product->name }} (${{ $product->price }})
                            </option>
                        @endforeach

                    </select>

                    <input type="number" name="products[0][quantity]" class="border p-2 rounded w-24" placeholder="Qty">
                </div>

            </div>

            <!-- ADD PRODUCT -->
            <button type="button" onclick="addProduct()" class="mt-3 bg-gray-200 px-3 py-1 rounded text-sm">
                + Add Product
            </button>

            <!-- SUBMIT -->
            <div class="mt-6">
                <button class="bg-blue-500 text-white px-4 py-2 rounded">
                    Create Order
                </button>
            </div>

        </form>

    </div>

    <script>
        let index = 1;

        function addProduct() {
            let container = document.getElementById('products-container');

            container.innerHTML += `
        <div class="flex gap-3 mt-2">
            <select name="products[${index}][product_id]" class="border p-2 rounded w-full">
                <option value="">Select product</option>

                @foreach ($products as $product)
                    <option value="{{ $product->id }}">
                        {{ $product->name }} (${{ $product->price }})
                    </option>
                @endforeach

            </select>

            <input type="number" name="products[${index}][quantity]"
                class="border p-2 rounded w-24" placeholder="Qty">
        </div>
    `;

            index++;
        }
    </script>
@endsection
