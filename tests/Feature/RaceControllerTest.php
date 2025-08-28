<?php
namespace Tests\Feature;

use App\Services\RaceService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Mockery;
use Tests\TestCase;

class RaceControllerTest extends TestCase
{
    public function test_save_results_returns_success()
    {
        $mock = Mockery::mock(RaceService::class);
        $mock->shouldReceive('parseResults')->with(1234)->once();

        $this->app->instance(RaceService::class, $mock);

        $response = $this->getJson('/api/save-results/1234');

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'successfully',
            ]);
    }
}