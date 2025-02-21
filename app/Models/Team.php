<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
}
