<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($request->is('api/tags*') || $request->is('api/difficulties*')) {
            return [
                'data' => [
                    'type' => 'game',
                    'id' => $this->id,
                    'attributes' => [
                        'name' => $this->name,
                        'slug' => $this->slug,
                        'player_min' => $this->player_min,
                        'player_max' => $this->player_max,
                        'age' => $this->age,
                        'duration' => $this->duration,
                        'summary' => $this->summary,
                    ],
                    'relationships' => [
                        'difficulty' => new DifficultyResource($this->whenLoaded('difficulty')),
                        'tag' => new TagResource($this->whenLoaded('tag')),
                    ],
                ],
                'links' => [
                    'self' => route('games.index'),
                ],
            ];
        }

        return [
            'type' => 'game',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'slug' => $this->slug,
                'player_min' => $this->player_min,
                'player_max' => $this->player_max,
                'age' => $this->age,
                'duration' => $this->duration,
                'summary' => $this->summary,
                'description' => $this->description,
            ],
            'relationships' => [
                'tag' => new TagResource($this->whenLoaded('tag')),
                'difficulty' => new DifficultyResource($this->whenLoaded('difficulty')),
            ],
            'links' => [
                'self' => route('games.index'),
            ],
        ];
    }
}
