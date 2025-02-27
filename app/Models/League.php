<?php

namespace App\Models;

use App\Enums\LeagueStatus;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property int $season
 * @property int $teams_number
 * @property int $current_week
 * @property LeagueStatus $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Collection<Standing> $standings
 * @property Collection<Fixture> $fixtures
 * @property Collection<Team> $teams
 */
class League extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'season',
        'teams_number',
        'current_week',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => LeagueStatus::class,
    ];

    public function standings(): HasMany
    {
        return $this->hasMany(related: Standing::class)
            ->orderBy('points', 'desc')
            ->orderByRaw('(goals_for - goals_against) DESC')
            ->orderBy('played');

    }

    public function fixtures(): HasMany
    {
        return $this->hasMany(related: Fixture::class);
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Team::class,
            table: 'standings'
        )
            ->withPivot(['played', 'win', 'draw', 'lose', 'goals_for', 'goals_against', 'points'])
            ->withTimestamps();
    }
}
