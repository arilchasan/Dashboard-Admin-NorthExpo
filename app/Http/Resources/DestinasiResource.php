<?php

namespace App\Http\Resources;

use App\Http\Resources\KomentarResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DestinasiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
                
                'id' => $this->id,
                'nama' => $this->nama,
                'deskripsi' => $this->deskripsi,
                'alamat' => $this->alamat,
                'foto' => $this->foto,
                'foto2' => $this->foto2,
                'foto3' => $this->foto3,
                'foto4' => $this->foto4,
                'kategori' => $this->kategori->nama,
                'wilayah' => $this->wilayah->nama,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'maps' => $this->maps,
                'operasional' => $this->operasional,
                'pelayanan' => $this->pelayanan,
                'status' => $this->status,
                'komentars' => KomentarResource::collection($this->whenLoaded('komentars')),
                'harga' => $this->harga,
                'kuota' => $this->kuota,
        ];
    }
}
