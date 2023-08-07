<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Komentar_KulinerResource;

class KulinerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
     return[

        'id' => $this->id,
        'nama_warung' => $this->nama_warung,
        'alamat' => $this->alamat,
        'operasional' => $this->operasional,
        'nama_kuliner' => $this->nama_kuliner,
        'deskripsi' => $this->deskripsi,
        'harga' => $this->harga,
        'foto' => $this->foto,
        'foto2' => $this->foto2,
        'foto3' => $this->foto3,
        'customer_service' => $this->customer_service,
        'komentar_kuliners' => Komentar_KulinerResource::collection($this->whenLoaded('komentar_kuliners')),
        
     ];
      
    }
}
