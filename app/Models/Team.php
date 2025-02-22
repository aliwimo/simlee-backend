<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property float $strength
 * @property string $logo
 * @property string $stadium
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Collection<League> $leagues
 * @property Collection<Standing> $standings
 * @property Collection<Fixture> $homeFixtures
 * @property Collection<Fixture> $awayFixtures
 */
class Team extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'strength',
        'logo',
        'stadium',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [];

    public function leagues(): BelongsToMany
    {
        return $this->belongsToMany(
            related: League::class,
            table: 'standings'
        )
            ->withPivot(['played', 'win', 'draw', 'lose', 'goals_for', 'goals_against', 'points'])
            ->withTimestamps();
    }

    public function standings(): HasMany
    {
        return $this->hasMany(related: Standing::class);
    }

    public function homeFixtures(): HasMany
    {
        return $this->hasMany(
            related: Fixture::class,
            foreignKey: 'home_team_id'
        );
    }

    public function awayFixtures(): HasMany
    {
        return $this->hasMany(
            related: Fixture::class,
            foreignKey: 'away_team_id'
        );
    }
}
