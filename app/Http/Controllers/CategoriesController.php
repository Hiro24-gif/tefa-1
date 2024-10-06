<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
{
    $categories = Categories::all();
    $products = Products::all();
    return view('index', compact('categories', 'products'));
}


    public function create()
    {

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Categories::create([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function show(categories $id)
    {
        $categories = Categories::findOrFail($id); // Jika tidak ditemukan, akan melemparkan error 404
        $products = Products::where('category_id', $categories->id)->get();
        return view('produk', compact('categories', 'products'));
    }

    public function edit(Categories $categories)
    {

    }

    public function update(Request $request, Categories $categories)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $categories->update([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(Categories $categories)
    {
        $categories->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus');
    }
}
