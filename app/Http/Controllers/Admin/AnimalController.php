<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index()
    {
        $animals = Animal::with('user')->latest()->paginate(10);
        return view('admin.animals.index', compact('animals'));
    }

    public function create()
    {
        return view('admin.animals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'nama' => ['required', 'string', 'max:255'],
            'jenis' => ['required', 'string', 'max:255'],
            'ras' => ['nullable', 'string', 'max:255'],
            'jenis_kelamin' => ['nullable', 'in:jantan,betina'],
            'tanggal_lahir' => ['nullable', 'date'],
            'warna' => ['nullable', 'string', 'max:255'],
            'catatan' => ['nullable', 'string'],
        ]);

        Animal::create($request->all());

        return redirect()->route('admin.animals.index')->with('success', 'Data hewan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $animal = Animal::with('user')->findOrFail($id);
        return view('admin.animals.edit', compact('animal'));
    }

    public function update(Request $request, $id)
    {
        $animal = Animal::findOrFail($id);

        $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'nama' => ['required', 'string', 'max:255'],
            'jenis' => ['required', 'string', 'max:255'],
            'ras' => ['nullable', 'string', 'max:255'],
            'jenis_kelamin' => ['nullable', 'in:jantan,betina'],
            'tanggal_lahir' => ['nullable', 'date'],
            'warna' => ['nullable', 'string', 'max:255'],
            'catatan' => ['nullable', 'string'],
        ]);

        $animal->update($request->all());

        return redirect()->route('admin.animals.index')->with('success', 'Data hewan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $animal = Animal::findOrFail($id);
        $animal->delete();

        return redirect()->route('admin.animals.index')->with('success', 'Data hewan berhasil dihapus!');
    }
}

