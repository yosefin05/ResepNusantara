<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resep;
use App\Http\Resources\ResepResource;

class ApiResepController extends Controller
{
    public function index()
    {
        return ResepResource::collection(Resep::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'bahan' => 'required',
            'langkah' => 'required',
        ]);

        $resep = Resep::create($request->all());

        return new ResepResource($resep);
    }

    public function show($id)
    {
        $resep = Resep::findOrFail($id);
        return new ResepResource($resep);
    }

    public function update(Request $request, $id)
    {
        $resep = Resep::findOrFail($id);
        $resep->update($request->all());

        return new ResepResource($resep);
    }

    public function destroy($id)
    {
        $resep = Resep::findOrFail($id);
        $resep->delete();

        return response()->json(null, 204);
    }
}
