<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::orderBy('kode')->paginate(10);

        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => ['required', 'string', 'max:20', 'unique:courses,kode'],
            'nama' => ['required', 'string', 'max:255'],
        ]);

        Course::create($validated);

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Mata kuliah baru berhasil ditambahkan.');
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'kode' => ['required', 'string', 'max:20', 'unique:courses,kode,' . $course->id],
            'nama' => ['required', 'string', 'max:255'],
        ]);

        $course->update($validated);

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Mata kuliah berhasil dihapus.');
    }
}

