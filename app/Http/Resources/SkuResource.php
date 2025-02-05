<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SkuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'packaging' => $this->packaging,
            'description' => $this->description,
            'image' => $this->image->path ?? null,
            'brand' => $this->product->name,
            'category' => $this->product->category->name,
            'file' => $this->file ? asset('storage/'.$this->file) : null,
        ];
    }
}
