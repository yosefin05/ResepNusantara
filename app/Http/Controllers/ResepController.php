<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resep;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ResepController extends Controller
{
    // Tampilkan daftar resep di halaman dashboard
    public function index()
    {
        $reseps = Resep::with('user')->latest()->paginate(12);
        return view('dashboard', compact('reseps'));
    }

    // Tampilkan resep milik user yang login
    public function myIndex()
    {
        $reseps = Resep::where('user_id', auth()->id())
                    ->latest()
                    ->paginate(12);
        return view('reseps.my-index', compact('reseps'));
    }

    // Tampilkan form create
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
        return view('reseps.create');
    }

    // Tampilkan detail resep
    public function show($id)
    {
        $resep = Resep::with('user')->findOrFail($id);
        return view('reseps.show', compact('resep'));
    }


    // Tampilkan form edit
    public function edit($id)
    {
        $resep = Resep::findOrFail($id);

        // Authorization
        if (Auth::user()->role !== 'admin' && Auth::id() !== $resep->user_id) {
            abort(403, 'Akses ditolak.');
        }

        return view('reseps.edit', compact('resep'));
    }

    // Simpan resep baru

     // Simpan resep baru
    public function store(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'bahan' => 'required|string',
            'langkah' => 'required|string',
        ]);

        // Pastikan file gambar ada
        if (!$request->hasFile('gambar')) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'File gambar tidak ditemukan');
        }

        // Proses upload gambar
        try {
        $gambarPath = $request->file('gambar')->store('resep_images', 'public');

            // Simpan data ke database
            $resep = new Resep();
            $resep->judul = $validatedData['judul'];
            $resep->gambar = $gambarPath;
            $resep->bahan = $validatedData['bahan'];
            $resep->langkah = $validatedData['langkah'];
            $resep->user_id = Auth::id();
            $resep->save();

            return redirect()->route('reseps.index');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan resep: ' . $e->getMessage());
        }
    }

        // Update resep    
    public function update(Request $request, $id)
    {
        $resep = Resep::findOrFail($id);
        
        if (Auth::user()->role !== 'admin' && Auth::id() !== $resep->user_id) {
            abort(403, 'Akses ditolak.');
        }

        $validated = $request->validate([
            'judul' => 'required|max:255',
            'bahan' => 'required',
            'langkah' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'Format gambar harus jpeg, png, atau jpg',
            'gambar.max' => 'Ukuran gambar maksimal 2MB'
        ]);

        // Handle gambar hanya jika diupload baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            Storage::disk('public')->delete($resep->gambar);
            
            // Upload gambar baru
            $file = $request->file('gambar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $validated['gambar'] = $file->storeAs('resep_images', $fileName, 'public');
        } else {
            // Pertahankan gambar lama jika tidak diupdate
            $validated['gambar'] = $resep->gambar;
        }

        $resep->update($validated);

        return redirect()->route('reseps.show', $resep->id)
            ->with('success', 'Resep berhasil diperbarui!');
    }


    // Hapus resep
    public function destroy($id)
    {
        $resep = Resep::findOrFail($id);

        // Authorization
        if (Auth::user()->role !== 'admin' && Auth::id() !== $resep->user_id) {
            abort(403, 'Akses ditolak.');
        }

        // Hapus gambar
        if ($resep->gambar) {
            Storage::disk('public')->delete($resep->gambar);
        }

        $resep->delete();

        return redirect()->route('reseps.my-index')->with('success', 'Resep berhasil dihapus!');
    }
}