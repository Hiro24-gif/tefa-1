<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        return view('index');
    }

    public function about()
    {
        return view('about');
    }
    public function cvt()
{
    $products = products::where('category_id', 1)->get(); // '1' untuk kategori CVT
    return view('categories.cvt', compact('products'));
}

public function valve()
{
    $products = Products::where('category_id', 2)->get(); // '2' untuk kategori Valve
    return view('categories.valve', compact('products'));
}

public function clutch()
{
    $products = Products::where('category_id', 3)->get(); // '3' untuk kategori Clutch
    return view('categories.clutch', compact('products'));
}

public function sentri()
{
    $products = Products::where('category_id', 4)->get(); // '4' untuk kategori Sentri
    return view('categories.sentri', compact('products'));
}

public function showProduct($id)
{
    $products = Products::find($id);
    // Ambil produk berdasarkan ID yang dipilih
    $productDetail = Products::findOrFail($id);

    // Ambil produk lain di kategori yang sama, kecuali produk yang sedang ditampilkan
    $relatedProducts = Products::where('category_id', $productDetail->category_id)
                               ->where('id', '!=', $id)
                               ->get();

    // Kirim data ke view
    return view('product.show', compact('productDetail', 'relatedProducts', 'products'));
}

    public function create()
    {
        $categories = Categories::all();
        return view('dashboard', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'Model' => 'required|string',
            'Wire' => 'required|string',
            'Outside' => 'required|string',
            'Free_height' => 'required|string',
            'Solid_height' => 'required|string',
            'Spring_rate' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id'
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        Products::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
            'Model' => $request->Model,
            'Wire' => $request->Wire,
            'Outside' => $request->Outside,
            'Free_height' => $request->Free_height,
            'Solid_height' => $request->Solid_height,
            'Spring_rate' => $request->Spring_rate,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('products.index')->with('success', 'Product added successfully');
    }

    public function edit(Products $product)
    {
        $categories = Categories::all();
        return view('admin.products.form', ['product' => $product, 'categories' => $categories]);
    }

    public function update(Request $request, Products $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'Model' => 'required|string',
            'Wire' => 'required|string',
            'Outside' => 'required|string',
            'Free_height' => 'required|string',
            'Solid_height' => 'required|string',
            'Spring_rate' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id'
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::delete('public/' . $product->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = $product->image;
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
            'Model' => $request->Model,
            'Wire' => $request->Wire,
            'Outside' => $request->Outside,
            'Free_height' => $request->Free_height,
            'Solid_height' => $request->Solid_height,
            'Spring_rate' => $request->Spring_rate,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function destroy(Products $product)
    {
        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }
        $product->delete();
        return redirect()->route('index')->with('success', 'Product deleted successfully');
    }
}
