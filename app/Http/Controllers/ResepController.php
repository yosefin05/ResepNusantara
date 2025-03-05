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
        $resep = Resep::with('user')->findOrFail($id); // Ambil resep berdasarkan ID
        return view('reseps.show', compact('resep')); // Tampilkan view detail resep
    }
    
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'bahan' => 'required|string',
            'langkah' => 'required|string',
        ]);

        // Simpan ke database
        Resep::create([
            'judul' => $request->input('judul'),
            'bahan' => $request->input('bahan'),
            'langkah' => $request->input('langkah'),
            'user_id' => Auth::id(),
        ]);
        

        return redirect('/')->with('success', 'Resep berhasil diunggah!');
    }
}
