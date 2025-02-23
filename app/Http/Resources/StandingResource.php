<?php

namespace App\Http\Resources;

use App\Models\Standing;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Standing
 */
class StandingResource extends JsonResource
{
    /**
     * @inheritDoc
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'team_id' => $this->team_id,
            'played' => $this->whenNotNull($this->played),
            'win' => $this->whenNotNull($this->win),
            'draw' => $this->whenNotNull($this->draw),
            'lose' => $this->whenNotNull($this->lose),
            'goals_for' => $this->whenNotNull($this->goals_for),
            'goals_against' => $this->whenNotNull($this->goals_against),
            'points' => $this->whenNotNull($this->points),
            'team' => TeamResource::make($this->whenLoaded('team')),
        ];
    }
}
