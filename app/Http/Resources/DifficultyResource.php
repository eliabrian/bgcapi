<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DifficultyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($request->is('api/games*')) {
            return [
                'data' => [
                    'type' => 'difficulty',
                    'id' => $this->id,
                    'attributes' => [
                        'name' => $this->name,
                    ]
                ],
                'links' => [
                    'self' => route('difficulties.index'),
                ],
            ];
        }

        return [
            'type' => 'difficulty',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'slug' => $this->slug,
            ],
            'relationships' => [
                'games' => GameResource::collection($this->whenLoaded('games')),
            ],
            'links' => [
                'self' => route('difficulties.index'),
            ],
        ];
    }
}
