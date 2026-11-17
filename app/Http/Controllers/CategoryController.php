<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('transactions')->latest()->paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|in:pemasukan,pengeluaran',
            'description' => 'nullable|string|max:255'
        ]);

        Category::create($request->all());
        return back()->with('success', 'Kategori baru berhasil disimpan.');
    }

    public function destroy(Category $kategori)
    {
        $kategori->delete();
        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}
