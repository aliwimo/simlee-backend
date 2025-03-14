<?php

namespace App\Http\Resources;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Team
 */
class TeamResource extends JsonResource
{
    /**
     * @inheritDoc
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->whenNotNull($this->slug),
            'strength' => $this->whenNotNull($this->strength),
            'logo' => $this->logo ? asset($this->logo) : null,
            'stadium' => $this->whenNotNull($this->stadium),
        ];
    }
}
