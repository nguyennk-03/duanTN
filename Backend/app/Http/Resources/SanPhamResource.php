<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SanPhamResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->tensp,
            'image' => asset('storage/' . $this->img),
            'description' => $this->mota,
            'price' => $this->giaban,
            'discount_price' => $this->giagiam,
            'quantity' => $this->soluong,
            'category' => $this->danhmuc_id->tendm ?? null,
            'brand' => $this->thuonghieu_id->tenth ?? null,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
