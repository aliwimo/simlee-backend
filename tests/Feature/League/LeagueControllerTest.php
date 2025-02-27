<?php

namespace Tests\Feature\League;

use App\Models\League;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeagueControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test fetching an existing league.
     */
    public function testFetchLeagueData()
    {
        /** @var League $league */
        $league = League::factory()->create();

        $response = $this->getJson("/api/v1/leagues/$league->id");

        $response
            ->assertStatus(200)
            ->assertJson([
                'id' => $league->id,
                'name' => $league->name,
                'season' => $league->season,
            ]);
    }

    /**
     * Test fetching a non-existent league.
     */
    public function testFetchNotFoundLeague()
    {
        $response = $this->getJson('/api/v1/leagues/9999');

        $response
            ->assertStatus(404)
            ->assertJson([
                'message' => 'Resource not found.',
            ]);
    }

    /**
     * Test creating a new league.
     */
    public function testCreateLeague()
    {
        $response = $this->postJson('/api/v1/leagues', [
            'name' => 'New League',
            'season' => 2025,
            'teams_number' => 12,
        ]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'name' => 'New League',
                'season' => 2025,
                'teams_number' => 12,
            ]);

        $this->assertDatabaseHas('leagues', ['name' => 'New League']);
    }

    /**
     * Test creating a new league.
     */
    public function testCreateLeagueWithSameNameFails()
    {
        League::create([
            'name' => 'New League',
            'season' => 2025,
            'teams_number' => 12,
        ]);

        $response = $this->postJson('/api/v1/leagues', [
            'name' => 'New League',
            'season' => 2025,
            'teams_number' => 12,
        ]);

        $response
            ->assertStatus(422)
            ->assertJson([
                "message" => "A league with this name already exists for the selected season.",
                "errors" => [
                    "name" => [
                        "A league with this name already exists for the selected season."
                    ]
                ]
            ]);

        $this->assertDatabaseHas('leagues', ['name' => 'New League']);
    }

    /**
     * Test validation errors on league creation.
     */
    public function testValidationErrorsOnCreateLeague()
    {
        $response = $this->postJson('/api/v1/leagues', [
            'name' => '',
            'season' => 'invalid',
            'teams_number' => -1,
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'season', 'teams_number']);
    }

    /**
     * Test fetching all leagues.
     */
    public function testFetchAllLeagues()
    {
        League::factory()->count(5)->create();

        $response = $this->getJson('/api/v1/leagues');

        $response
            ->assertStatus(200)
            ->assertJsonCount(5);
    }
}
