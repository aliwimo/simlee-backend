<?php

namespace App\Models;

use App\Enums\LeagueStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property int $season
 * @property int $teams_number
 * @property LeagueStatus $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class League extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'season',
        'teams_number',
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
}
