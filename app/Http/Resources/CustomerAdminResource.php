<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerAdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "fullName" => $this['fullName'] ?? $this['name'],
            "companyName" => $this['companyName'] ?? $this['store_name'],
            "whatsappNumber" => $this['whatsappNumber'] ?? $this['phone'],
            "companyEmail" => $this['companyEmail'] ?? "-",
            "fullAddress" => $this['fullAddress'] ?? $this['address'],
        ];
    }
}
