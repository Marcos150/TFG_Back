<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'email' => $this->email,
            'num_of_sheet_music' => $this->sheetMusic()->count(),
            'favorite_authors' => $this->sheetMusic()
                ->select('author')
                ->groupBy('author')
                ->orderByRaw('COUNT(*) DESC')
                ->limit(5)
                ->pluck('author'),
        ];  
    }
}
