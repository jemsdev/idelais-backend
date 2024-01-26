<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\FacilitiesResource;
use App\Models\VillaFacility;
use App\Models\VillaGallery;

class VillaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "sub_category_id" => $this->sub_category_id,
            "sub_category_value" => $this->sub_category_value,
            "thumbnail" => $this->thumbnail,
            "description" => $this->description,
            "alamat" => $this->alamat,
            "whatsapp_number" => $this->whatsapp_number,
            "sub_district" => $this->sub_district,
            "price" => $this->price,
            "code" => $this->code,
            "is_recommendation" => $this->is_recommendation,
            "gambar" => url('storage/images/'.VillaGallery::select(['id', 'image'])->where('villa_id', $this->id)->first()->image),
            "facilities" => FacilitiesResource::collection(VillaFacility::select(['id', 'icon', 'title'])->where('villa_id', $this->id)->limit(4)->get())
        ];
    }
}
