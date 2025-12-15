<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vaccination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    /**
     * Menampilkan daftar transaksi pembayaran
     */
    public function index()
    {
        $vaccinations = Vaccination::with('animal.user')
            ->whereNotNull('amount')
            ->latest()
            ->paginate(15);
        
        return view('admin.transactions.index', compact('vaccinations'));
    }

    /**
     * Menampilkan detail transaksi
     */
    public function show($id)
    {
        $vaccination = Vaccination::with('animal.user')->findOrFail($id);
        return view('admin.transactions.show', compact('vaccination'));
    }

    /**
     * Set nominal pembayaran untuk vaksinasi
     */
    public function setAmount(Request $request, $id)
    {
        $vaccination = Vaccination::findOrFail($id);

        $request->validate([
            'amount' => ['required', 'numeric', 'min:0'],
            'payment_method' => ['nullable', 'string', 'max:255'],
        ]);

        $vaccination->update([
            'amount' => $request->amount,
            'payment_method' => $request->payment_method ?? 'Transfer Bank',
            'payment_status' => 'pending',
        ]);

        return redirect()->route('admin.transactions.index')
            ->with('success', 'Nominal pembayaran berhasil ditetapkan!');
    }

    /**
     * Verifikasi pembayaran (set status menjadi paid/verified)
     */
    public function verifyPayment(Request $request, $id)
    {
        $vaccination = Vaccination::findOrFail($id);

        $request->validate([
            'payment_status' => ['required', 'in:verified,rejected'],
            'payment_note' => ['nullable', 'string'],
        ]);

        $vaccination->update([
            'payment_status' => $request->payment_status,
            'payment_note' => $request->payment_note,
        ]);

        $statusText = $request->payment_status === 'verified' ? 'diverifikasi' : 'ditolak';
        
        return redirect()->route('admin.transactions.show', $id)
            ->with('success', "Pembayaran berhasil {$statusText}!");
    }

    /**
     * Download bukti pembayaran
     */
    public function downloadProof($id)
    {
        $vaccination = Vaccination::findOrFail($id);
        
        if (!$vaccination->payment_proof) {
            return redirect()->back()->with('error', 'Bukti pembayaran tidak ditemukan.');
        }

        // Check if file exists on public disk
        if (!Storage::disk('public')->exists($vaccination->payment_proof)) {
            return redirect()->back()->with('error', 'File bukti pembayaran tidak ditemukan di storage.');
        }

        return Storage::disk('public')->download($vaccination->payment_proof);
    }
}
