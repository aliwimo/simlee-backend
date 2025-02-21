<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{

    private array $teams = [
        [
            'name' => 'Arsenal',
            'slug' => 'arsenal',
            'strength' => 0.91,
            'logo' => '',
            'stadium' => 'Emirates Stadium'
        ],
        [
            'name' => 'Aston Villa',
            'slug' => 'aston-villa',
            'strength' => 0.85,
            'logo' => '',
            'stadium' => 'Villa Park'
        ],
        [
            'name' => 'Bournemouth',
            'slug' => 'bournemouth',
            'strength' => 0.78,
            'logo' => '',
            'stadium' => 'Vitality Stadium'
        ],
        [
            'name' => 'Brentford',
            'slug' => 'brentford',
            'strength' => 0.80,
            'logo' => '',
            'stadium' => 'Brentford Community Stadium'
        ],
        [
            'name' => 'Brighton & Hove Albion',
            'slug' => 'brighton',
            'strength' => 0.88,
            'logo' => '',
            'stadium' => 'Amex Stadium'
        ],
        [
            'name' => 'Burnley',
            'slug' => 'burnley',
            'strength' => 0.75,
            'logo' => '',
            'stadium' => 'Turf Moor'
        ],
            [
            'name' => 'Chelsea',
            'slug' => 'chelsea',
            'strength' => 0.90,
            'logo' => '',
            'stadium' => 'Stamford Bridge'
        ],
        [
            'name' => 'Crystal Palace',
            'slug' => 'crystal-palace',
            'strength' => 0.82,
            'logo' => '',
            'stadium' => 'Selhurst Park'
        ],
        [
            'name' => 'Everton',
            'slug' => 'everton',
            'strength' => 0.79,
            'logo' => '',
            'stadium' => 'Goodison Park'
        ],
        [
            'name' => 'Fulham',
            'slug' => 'fulham',
            'strength' => 0.81,
            'logo' => '',
            'stadium' => 'Craven Cottage'
        ],
        [
            'name' => 'Liverpool',
            'slug' => 'liverpool',
            'strength' => 0.92,
            'logo' => '',
            'stadium' => 'Anfield'
        ],
        [
            'name' => 'Luton Town',
            'slug' => 'luton',
            'strength' => 0.72,
            'logo' => '',
            'stadium' => 'Kenilworth Road'
        ],
        [
            'name' => 'Manchester City',
            'slug' => 'manchester-city',
            'strength' => 0.95,
            'logo' => '',
            'stadium' => 'Etihad Stadium'
        ],
        [
            'name' => 'Manchester United',
            'slug' => 'manchester-united',
            'strength' => 0.93,
            'logo' => '',
            'stadium' => 'Old Trafford'
        ],
        [
            'name' => 'Newcastle United',
            'slug' => 'newcastle-united',
            'strength' => 0.90,
            'logo' => '',
            'stadium' => 'St James\' Park'
        ],
        [
            'name' => 'Nottingham Forest',
            'slug' => 'nottingham-forest',
            'strength' => 0.77,
            'logo' => '',
            'stadium' => 'City Ground'
        ],
        [
            'name' => 'Sheffield United',
            'slug' => 'sheffield-united',
            'strength' => 0.73,
            'logo' => '',
            'stadium' => 'Bramall Lane'
        ],
        [
            'name' => 'Tottenham Hotspur',
            'slug' => 'tottenham',
            'strength' => 0.89,
            'logo' => '',
            'stadium' => 'Tottenham Hotspur Stadium'
        ],
        [
            'name' => 'West Ham United',
            'slug' => 'west-ham',
            'strength' => 0.83,
            'logo' => '',
            'stadium' => 'London Stadium'
        ],
        [
            'name' => 'Wolverhampton Wanderers',
            'slug' => 'wolves',
            'strength' => 0.80,
            'logo' => '',
            'stadium' => 'Molineux Stadium'
        ],
    ];


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->teams as $team) {
            Team::create($team);
        }
    }
}
