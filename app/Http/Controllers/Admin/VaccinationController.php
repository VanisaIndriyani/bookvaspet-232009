<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vaccination;
use App\Models\Animal;
use Illuminate\Http\Request;

class VaccinationController extends Controller
{
    public function index()
    {
        $vaccinations = Vaccination::with('animal.user')->latest()->paginate(10);
        return view('admin.vaccinations.index', compact('vaccinations'));
    }

    public function create()
    {
        $animals = Animal::with('user')->latest()->get();
        return view('admin.vaccinations.create', compact('animals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'animal_id' => ['required', 'exists:animals,id'],
            'jenis_vaksin' => ['required', 'string', 'max:255'],
            'tanggal_vaksin' => ['required', 'date'],
            'tanggal_booster' => ['nullable', 'date', 'after:tanggal_vaksin'],
            'dokter' => ['nullable', 'string', 'max:255'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'catatan' => ['nullable', 'string'],
            'amount' => ['nullable', 'numeric', 'min:0'],
            'payment_method' => ['nullable', 'string', 'max:255'],
        ]);

        $data = $request->all();
        
        // Jika amount diisi, set payment_status menjadi pending
        if ($request->filled('amount')) {
            $data['payment_status'] = 'pending';
        }

        Vaccination::create($data);

        return redirect()->route('admin.vaccinations.index')->with('success', 'Riwayat vaksin berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $vaccination = Vaccination::with('animal.user')->findOrFail($id);
        $animals = Animal::with('user')->latest()->get();
        return view('admin.vaccinations.edit', compact('vaccination', 'animals'));
    }

    public function update(Request $request, $id)
    {
        $vaccination = Vaccination::findOrFail($id);

        $request->validate([
            'animal_id' => ['required', 'exists:animals,id'],
            'jenis_vaksin' => ['required', 'string', 'max:255'],
            'tanggal_vaksin' => ['required', 'date'],
            'tanggal_booster' => ['nullable', 'date', 'after:tanggal_vaksin'],
            'dokter' => ['nullable', 'string', 'max:255'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'catatan' => ['nullable', 'string'],
            'amount' => ['nullable', 'numeric', 'min:0'],
            'payment_method' => ['nullable', 'string', 'max:255'],
        ]);

        $data = $request->all();
        
        // Jika amount diisi dan sebelumnya belum ada, set payment_status menjadi pending
        if ($request->filled('amount') && !$vaccination->amount) {
            $data['payment_status'] = 'pending';
        }

        $vaccination->update($data);

        return redirect()->route('admin.vaccinations.index')->with('success', 'Riwayat vaksin berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $vaccination = Vaccination::findOrFail($id);
        $vaccination->delete();

        return redirect()->route('admin.vaccinations.index')->with('success', 'Riwayat vaksin berhasil dihapus!');
    }
}

