<?php

namespace App\Http\Controllers;

use App\Models\Vaccination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    /**
     * Menampilkan daftar transaksi pembayaran user
     */
    public function index()
    {
        $user = Auth::user();
        
        $vaccinations = Vaccination::with('animal')
            ->whereHas('animal', fn ($query) => $query->where('user_id', $user->id))
            ->whereNotNull('amount')
            ->latest()
            ->paginate(15);
        
        return view('transactions.index', compact('vaccinations'));
    }

    /**
     * Menampilkan detail transaksi dan form upload bukti
     */
    public function show($id)
    {
        $user = Auth::user();
        $vaccination = Vaccination::with('animal')
            ->whereHas('animal', fn ($query) => $query->where('user_id', $user->id))
            ->findOrFail($id);
        
        return view('transactions.show', compact('vaccination'));
    }

    /**
     * Upload bukti pembayaran
     */
    public function uploadProof(Request $request, $id)
    {
        $user = Auth::user();
        $vaccination = Vaccination::with('animal')
            ->whereHas('animal', fn ($query) => $query->where('user_id', $user->id))
            ->findOrFail($id);

        $request->validate([
            'payment_proof' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'payment_method' => ['nullable', 'string', 'max:255'],
        ]);

        // Hapus bukti lama jika ada
        if ($vaccination->payment_proof) {
            Storage::delete($vaccination->payment_proof);
        }

        // Simpan bukti baru
        $path = $request->file('payment_proof')->store('payment_proofs', 'public');

        $vaccination->update([
            'payment_proof' => $path,
            'payment_method' => $request->payment_method ?? 'Transfer Bank',
            'payment_status' => 'paid', // Status berubah menjadi paid setelah upload bukti
        ]);

        return redirect()->route('transactions.show', $id)
            ->with('success', 'Bukti pembayaran berhasil diupload! Menunggu verifikasi dari dokter.');
    }
}
