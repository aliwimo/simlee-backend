<?php

namespace App\Http\Resources;

use App\Models\League;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin League
 */
class LeagueResource extends JsonResource
{
    /**
     * @inheritDoc
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'season' => $this->whenNotNull($this->season),
            'teams_number' => $this->whenNotNull($this->teams_number),
            'status' => $this->whenNotNull($this->status->value),
        ];
    }
}
