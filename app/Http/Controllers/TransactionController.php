<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    public function index(Request $request, $type)
    {
        abort_unless(in_array($type, ['pemasukan', 'pengeluaran']), 404);

        $query = Transaction::with('category', 'user')->where('type', $type);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('transaction_date', [$request->start_date, $request->end_date]);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $transactions = $query->latest('transaction_date')->paginate(10);
        $categories = Category::where('type', $type)->get();

        return view('transactions.index', compact('transactions', 'categories', 'type'));
    }

    public function store(Request $request, $type)
    {
        abort_unless(in_array($type, ['pemasukan', 'pengeluaran']), 404);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:100',
            'transaction_date' => 'required|date',
            'description' => 'required|string|max:255',
            'proof_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $filePath = null;
        if ($request->hasFile('proof_file')) {
            $filePath = $request->file('proof_file')->store('proofs', 'public');
        }

        Transaction::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'type' => $type,
            'amount' => $request->amount,
            'transaction_date' => $request->transaction_date,
            'description' => $request->description,
            'proof_file' => $filePath
        ]);

        return back()->with('success', 'Data ' . ucfirst($type) . ' berhasil dicatat.');
    }

    public function destroy(Transaction $transaction)
    {
        if ($transaction->proof_file) {
            Storage::disk('public')->delete($transaction->proof_file);
        }
        $transaction->delete();

        return back()->with('success', 'Transaksi berhasil dihapus.');
    }
}
