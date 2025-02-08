<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SanPhamResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->MaSP,
            'name' => $this->TenSP,
            'image' => $this->IMG,
            'description' => $this->MoTa,
            'price' => $this->GiaBan,
            'discount_price' => $this->GiaGiam,
            'quantity' => $this->SoLuong,
            'category' => $this->category->TenDM ?? null,
            'brand' => $this->brand->TenTH ?? null,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
