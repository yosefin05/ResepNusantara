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
            $file = $request->file('gambar');
            
            // Generate nama unik untuk file
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            // Simpan file ke storage
            $path = $file->storeAs('public/resep_images', $fileName);
            
            // Simpan path relatif ke database (tanpa 'public/')
            $gambarPath = str_replace('public/', '', $path);

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

    // Update resep
    public function update(Request $request, $id)
    {
        $resep = Resep::findOrFail($id);
        
        // Authorization
        if (Auth::user()->role !== 'admin' && Auth::id() !== $resep->user_id) {
            abort(403, 'Akses ditolak.');
        }

        $validated = $request->validate([
        'judul' => 'required|max:255',
        'bahan' => 'required',
        'langkah' => 'required',
        'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
    ], [
        'gambar.image' => 'File harus berupa gambar',
        'gambar.mimes' => 'Format gambar harus jpeg, png, atau jpg',
        'gambar.max' => 'Ukuran gambar maksimal 2MB'
    ]);

        

        // Handle gambar
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($resep->gambar) {
                Storage::disk('public')->delete($resep->gambar);
            }
            // Upload gambar baru
            $validated['gambar'] = $request->file('gambar')->store('resep-images', 'public');
        } else {
            $validated['gambar'] = $resep->gambar;
        }

        $resep->update($validated);

        return redirect()->route('reseps.show', $resep->id)->with('success', 'Resep berhasil diperbarui!');
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