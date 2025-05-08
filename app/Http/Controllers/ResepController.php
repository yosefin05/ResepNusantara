<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resep;
use Illuminate\Support\Facades\Auth;

class ResepController extends Controller
{
    // Tampilkan daftar resep di halaman dashboard
    public function index()
    {
        $reseps = Resep::with('user')->latest()->get(); // Ambil semua resep terbaru
        return view('dashboard', compact('reseps'));
    }

    public function create()
    {
        // Pastikan user sudah login sebelum mengakses halaman upload
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        return view('reseps.create'); // Menampilkan form upload resep
    }
    public function show($id)
{
    $resep = Resep::findOrFail($id);

    if (auth()->user()->role !== 'admin' && auth()->id() !== $resep->user_id) {
        abort(403, 'Akses ditolak.');
    }

    return view('reseps.show', compact('resep'));
}


public function store(Request $request)
{
    $validated = $request->validate([
        'judul' => 'required|string|max:255',
        'bahan' => 'required|string',
        'langkah' => 'required|string',
    ]);

    $validated['user_id'] = auth()->id(); // Tetapkan pemiliknya

    Resep::create($validated);

    return redirect()->route('reseps.index')->with('success', 'Resep berhasil ditambahkan.');
}

    // Menampilkan form edit
    public function edit($id)
    {
        $resep = Resep::findOrFail($id);

        // Cek apakah user adalah admin atau pemilik resep
        if (Auth::user()->role !== 'admin' && Auth::id() !== $resep->user_id) {
            abort(403, 'Akses ditolak.');
        }

        return view('reseps.edit', compact('resep'));
    }

    // Memproses update
    public function update(Request $request, $id)
{
    $resep = Resep::findOrFail($id);

    if (auth()->user()->role !== 'admin' && auth()->id() !== $resep->user_id) {
        abort(403, 'Akses ditolak.');
    }

    $validated = $request->validate([
        'judul' => 'required|string|max:255',
        'bahan' => 'required|string',
        'langkah' => 'required|string',
    ]);

    $resep->update($validated);

    return redirect()->route('reseps.index')->with('success', 'Resep berhasil diperbarui.');
}

    public function destroy($id)
    {
        $resep = Resep::findOrFail($id);

        // Hanya admin atau pemilik resep yang boleh menghapus
        if (Auth::user()->role !== 'admin' && Auth::id() !== $resep->user_id) {
            abort(403, 'Akses ditolak.');
        }

        $resep->delete();

        return redirect()->route('reseps.index')->with('success', 'Resep berhasil dihapus.');
    }
}
