<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Jika dokter hewan, lihat semua hewan
        // Jika user biasa, lihat hanya hewan miliknya
        if (Auth::user()->role === 'dokter_hewan') {
            $animals = Animal::with('user')->latest()->paginate(10);
        } else {
            $animals = Animal::where('user_id', Auth::id())->latest()->paginate(10);
        }

        return view('animals.index', compact('animals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('animals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'jenis' => ['required', 'string', 'max:255'],
            'ras' => ['nullable', 'string', 'max:255'],
            'jenis_kelamin' => ['nullable', 'in:jantan,betina'],
            'tanggal_lahir' => ['nullable', 'date'],
            'warna' => ['nullable', 'string', 'max:255'],
            'catatan' => ['nullable', 'string'],
        ]);

        Animal::create([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'ras' => $request->ras,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'warna' => $request->warna,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('animals.index')->with('success', 'Data hewan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $animal = Animal::findOrFail($id);
        
        // Cek akses: user biasa hanya bisa lihat hewan miliknya
        if (Auth::user()->role !== 'dokter_hewan' && $animal->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk melihat data ini.');
        }

        return view('animals.show', compact('animal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $animal = Animal::findOrFail($id);
        
        // Cek akses: user biasa hanya bisa edit hewan miliknya
        if (Auth::user()->role !== 'dokter_hewan' && $animal->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data ini.');
        }

        return view('animals.edit', compact('animal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $animal = Animal::findOrFail($id);
        
        // Cek akses: user biasa hanya bisa update hewan miliknya
        if (Auth::user()->role !== 'dokter_hewan' && $animal->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengupdate data ini.');
        }

        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'jenis' => ['required', 'string', 'max:255'],
            'ras' => ['nullable', 'string', 'max:255'],
            'jenis_kelamin' => ['nullable', 'in:jantan,betina'],
            'tanggal_lahir' => ['nullable', 'date'],
            'warna' => ['nullable', 'string', 'max:255'],
            'catatan' => ['nullable', 'string'],
        ]);

        $animal->update($request->only([
            'nama', 'jenis', 'ras', 'jenis_kelamin', 
            'tanggal_lahir', 'warna', 'catatan'
        ]));

        return redirect()->route('animals.index')->with('success', 'Data hewan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $animal = Animal::findOrFail($id);
        
        // Cek akses: user biasa hanya bisa hapus hewan miliknya
        if (Auth::user()->role !== 'dokter_hewan' && $animal->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus data ini.');
        }

        $animal->delete();

        return redirect()->route('animals.index')->with('success', 'Data hewan berhasil dihapus!');
    }
}

