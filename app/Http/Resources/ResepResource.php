<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResepResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'judul' => $this->judul,
            'bahan' => $this->bahan,
            'langkah' => $this->langkah,
            'gambar' => $this->gambar_url ?? null,
            'penulis' => $this->user->name ?? 'Anonim',
            'dibuat_pada' => $this->created_at->format('d/m/Y H:i'),
        ];
    }
}
