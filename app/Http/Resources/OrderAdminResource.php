<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderAdminResource extends JsonResource
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
            "is_folow_up" => $this->order_id,
            "items" => $this->items,
            "data" => CustomerAdminResource::make($this->data ?? $this->customer),
            "created_at" => $this->created_at,
            "sales" => [
                "id" => $this->user->id ?? null,
                "name" => $this->user->name ?? null,
            ],
            "status" => $this->status,
        ];
    }
}
