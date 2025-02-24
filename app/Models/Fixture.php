<?php

namespace App\Models;

use App\Observers\FixtureObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $league_id
 * @property int $home_team_id
 * @property int $away_team_id
 * @property int $week
 * @property int $home_score
 * @property int $away_score
 * @property boolean $played
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property League $league
 * @property Team $homeTeam
 * @property Team $awayTeam
 */
#[ObservedBy([FixtureObserver::class])]
class Fixture extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'league_id',
        'home_team_id',
        'away_team_id',
        'week',
        'home_score',
        'away_score',
        'played',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'played' => 'boolean',
    ];

    public function league(): BelongsTo
    {
        return $this->belongsTo(related: League::class);
    }

    public function homeTeam(): BelongsTo
    {
        return $this->belongsTo(
            related: Team::class,
            foreignKey: 'home_team_id'
        );
    }

    public function awayTeam(): BelongsTo
    {
        return $this->belongsTo(
            related: Team::class,
            foreignKey: 'away_team_id'
        );
    }
}
