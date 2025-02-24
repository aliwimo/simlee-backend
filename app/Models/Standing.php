<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $league_id
 * @property int $team_id
 * @property int $played
 * @property int $win
 * @property int $draw
 * @property int $lose
 * @property int $goals_for
 * @property int $goals_against
 * @property int $points
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property League $league
 * @property Team $team
 */
class Standing extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'league_id',
        'team_id',
        'played',
        'win',
        'draw',
        'lose',
        'goals_for',
        'goals_against',
        'points',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [];

    public function league(): BelongsTo
    {
        return $this->belongsTo(related: League::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(related: Team::class);
    }
}
