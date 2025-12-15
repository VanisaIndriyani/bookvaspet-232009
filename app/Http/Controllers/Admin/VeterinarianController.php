<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class VeterinarianController extends Controller
{
    public function index()
    {
        $veterinarians = User::where('role', 'dokter_hewan')->latest()->paginate(10);
        return view('admin.veterinarians.index', compact('veterinarians'));
    }
}

