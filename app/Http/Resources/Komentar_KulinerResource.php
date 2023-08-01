<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Komentar_KulinerResource extends JsonResource
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
            'komentar_kuliner' => $this->komentar_kuliner,
            'user_id' => new UserResource($this->whenLoaded('user')),
            'kuliner_id' => new DestinasiResource($this->whenLoaded('kuliner')),
        ];
    }
}
