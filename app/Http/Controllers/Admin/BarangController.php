<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::orderBy('kode_barang')->paginate(10);

        return view('admin.barangs.index', compact('barangs'));
    }

    public function create()
    {
        return view('admin.barangs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_barang' => ['required', 'string', 'max:50', 'unique:barangs,kode_barang'],
            'nama_barang' => ['required', 'string', 'max:255'],
            'jenis_barang' => ['required', 'string', 'max:255'],
        ]);

        Barang::create($validated);

        return redirect()
            ->route('admin.barangs.index')
            ->with('success', 'Data barang baru berhasil ditambahkan.');
    }

    public function edit(Barang $barang)
    {
        return view('admin.barangs.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'kode_barang' => ['required', 'string', 'max:50', 'unique:barangs,kode_barang,' . $barang->id],
            'nama_barang' => ['required', 'string', 'max:255'],
            'jenis_barang' => ['required', 'string', 'max:255'],
        ]);

        $barang->update($validated);

        return redirect()
            ->route('admin.barangs.index')
            ->with('success', 'Data barang berhasil diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();

        return redirect()
            ->route('admin.barangs.index')
            ->with('success', 'Data barang berhasil dihapus.');
    }
}

