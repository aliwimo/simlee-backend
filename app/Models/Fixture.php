<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
 */
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
    protected $casts = [];
}
