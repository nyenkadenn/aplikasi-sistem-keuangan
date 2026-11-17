<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Category;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function index()
    {
        $budgets = Budget::with('category')->latest('year')->paginate(10);
        $categories = Category::where('type', 'pengeluaran')->get();
        return view('budgets.index', compact('budgets', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'year' => 'required|digits:4|integer',
            'allocated_amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string'
        ]);

        Budget::create($request->all());
        return back()->with('success', 'Rencana Anggaran Biaya (RAB) berhasil disimpan.');
    }

    public function destroy(Budget $anggaran)
    {
        $anggaran->delete();
        return back()->with('success', 'Anggaran berhasil dihapus.');
    }
}
