<?php

namespace Services;

use App\Clients\RaceApiClient;
use App\DTOs\Race\GetRaceDataDTO;
use App\Models\Race;
use App\Repositories\Api\RaceRepository;
use App\Services\RaceService;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use PHPUnit\Framework\TestCase;

class RaceServiceTest extends TestCase
{
    public function test_get_race_data_returns()
    {
        $mockRace = new Race([
            'driver_number' => 44,
            'lap_number' => 1,
            'duration_sector_1' => 30.5,
            'duration_sector_2' => 28.1,
            'duration_sector_3' => 29.9,
        ]);

        $mockRepository = $this->createMock(RaceRepository::class);
        $mockRepository->method('getRaceData')
            ->willReturn(EloquentCollection::make([$mockRace]));

        $service = new RaceService($mockRepository);

        $dto = new GetRaceDataDTO([44], '1-6', '1');

        $result = $service->getRaceData($dto);

        $this->assertEquals(
            ["lap 1: '44': 30.5"],
            $result
        );
    }

    public function test_parse_results_calls_create_with_parsed_data()
    {
        $apiMock = $this->createMock(RaceApiClient::class);
        $repoMock = $this->createMock(RaceRepository::class);

        $sampleData = [
            [
                'driver_number' => 44,
                'lap_number' => 1,
                'duration_sector_1' => 30.5,
                'duration_sector_2' => 29.1,
                'duration_sector_3' => 28.7,
            ]
        ];

        $apiMock->method('getResults')
            ->with(9939)
            ->willReturn($sampleData);

        $repoMock->expects($this->once())
            ->method('create')
            ->with($sampleData[0]);

        $service = new RaceService($repoMock, $apiMock);
        $service->parseResults(9939);
    }
}