<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('kode_buku')->paginate(10);

        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        return view('admin.books.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_buku' => ['required', 'string', 'max:50', 'unique:books,kode_buku'],
            'nama_pengarang' => ['required', 'string', 'max:255'],
            'nama_penulis' => ['required', 'string', 'max:255'],
        ]);

        Book::create($validated);

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Data buku baru berhasil ditambahkan.');
    }

    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'kode_buku' => ['required', 'string', 'max:50', 'unique:books,kode_buku,' . $book->id],
            'nama_pengarang' => ['required', 'string', 'max:255'],
            'nama_penulis' => ['required', 'string', 'max:255'],
        ]);

        $book->update($validated);

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Data buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Data buku berhasil dihapus.');
    }
}
