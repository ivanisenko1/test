<?php

namespace Models;

use App\Models\Race;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RaceTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_duration_lap()
    {
        $race = new Race([
            'duration_sector_1' => 52.33,
            'duration_sector_2' => 47.77,
            'duration_sector_3' => 20.86
        ]);

        $this->assertEquals(120.96, $race->durationLap);
    }
}
