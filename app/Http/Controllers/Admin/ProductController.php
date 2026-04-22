<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        // $products = Product::with('category')->latest()->get();
        // return view('admin.products.index', compact('products'));
        $products = Product::latest()->paginate(12);
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // ✅ Validation
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'nullable|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image',

            // optional fields
            'brand' => 'nullable|string',
            'discount' => 'nullable|numeric',
            'availability' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        // ✅ Fix checkboxes
        $data['isNew'] = $request->has('isNew');
        $data['requiresPrescription'] = $request->has('requiresPrescription');

        // ✅ Image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products.index');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
        if ($request->remove_image == "1") {
            if ($product->image) {
                Storage::delete('public/' . $product->image);
                $product->image = null;
            }
        }
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // ✅ Validation
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'nullable|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image',

            // optional fields
            'brand' => 'nullable|string',
            'discount' => 'nullable|numeric',
            'availability' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        // ✅ Fix checkboxes
        $data['isNew'] = $request->has('isNew');
        $data['requiresPrescription'] = $request->has('requiresPrescription');

        // ✅ Image update
        if ($request->hasFile('image')) {

            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index');
        if ($request->remove_image == "1") {
            if ($product->image) {
                Storage::delete('public/' . $product->image);
                $product->image = null;
            }
        }
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return back();
    }
}
