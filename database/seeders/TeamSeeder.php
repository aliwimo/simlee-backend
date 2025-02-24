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
            'stadium' => 'Emirates Stadium'
        ],
        [
            'name' => 'Aston Villa',
            'slug' => 'aston_villa',
            'strength' => 0.85,
            'stadium' => 'Villa Park'
        ],
        [
            'name' => 'Bournemouth',
            'slug' => 'bournemouth',
            'strength' => 0.78,
            'stadium' => 'Vitality Stadium'
        ],
        [
            'name' => 'Brentford',
            'slug' => 'brentford',
            'strength' => 0.80,
            'stadium' => 'Brentford Community Stadium'
        ],
        [
            'name' => 'Brighton & Hove Albion',
            'slug' => 'brighton',
            'strength' => 0.88,
            'stadium' => 'Amex Stadium'
        ],
        [
            'name' => 'Chelsea',
            'slug' => 'chelsea',
            'strength' => 0.90,
            'stadium' => 'Stamford Bridge'
        ],
        [
            'name' => 'Crystal Palace',
            'slug' => 'crystal_palace',
            'strength' => 0.82,
            'stadium' => 'Selhurst Park'
        ],
        [
            'name' => 'Everton',
            'slug' => 'everton',
            'strength' => 0.79,
            'stadium' => 'Goodison Park'
        ],
        [
            'name' => 'Fulham',
            'slug' => 'fulham',
            'strength' => 0.81,
            'stadium' => 'Craven Cottage'
        ],
        [
            'name' => 'Ipswich Town',
            'slug' => 'ipswich',
            'strength' => 0.65,
            'stadium' => 'Portman Road'
        ],
        [
            'name' => 'Leicester City',
            'slug' => 'leicester',
            'strength' => 0.79,
            'stadium' => 'King Power'
        ],
        [
            'name' => 'Liverpool',
            'slug' => 'liverpool',
            'strength' => 0.92,
            'stadium' => 'Anfield'
        ],
        [
            'name' => 'Manchester City',
            'slug' => 'manchester_city',
            'strength' => 0.95,
            'stadium' => 'Etihad Stadium'
        ],
        [
            'name' => 'Manchester United',
            'slug' => 'manchester_united',
            'strength' => 0.93,
            'stadium' => 'Old Trafford'
        ],
        [
            'name' => 'Newcastle United',
            'slug' => 'newcastle_united',
            'strength' => 0.90,
            'stadium' => 'St James\' Park'
        ],
        [
            'name' => 'Nottingham Forest',
            'slug' => 'nottingham_forest',
            'strength' => 0.77,
            'stadium' => 'City Ground'
        ],
        [
            'name' => 'Southampton',
            'slug' => 'southampton',
            'strength' => 0.73,
            'stadium' => 'St Mary\'s Stadium'
        ],
        [
            'name' => 'Tottenham Hotspur',
            'slug' => 'tottenham',
            'strength' => 0.89,
            'stadium' => 'Tottenham Hotspur Stadium'
        ],
        [
            'name' => 'West Ham United',
            'slug' => 'west_ham',
            'strength' => 0.83,
            'stadium' => 'London Stadium'
        ],
        [
            'name' => 'Wolverhampton Wanderers',
            'slug' => 'wolves',
            'strength' => 0.80,
            'stadium' => 'Molineux Stadium'
        ],
    ];


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->teams as $team) {
            $team['logo'] = "assets/logos/{$team['slug']}.svg";
            Team::create($team);
        }
    }
}
