<?php declare(strict_types=1);

namespace App\Services;

use App\Clients\RaceApiClient;
use App\DTOs\Race\GetRaceDataDTO;
use App\Models\Race;
use App\Repositories\Api\RaceRepository;

class RaceService
{
    public function __construct(
        protected RaceRepository $raceRepository,
        protected RaceApiClient $raceApiClient)
    {}

    public function parseResults(int $sessionKey): void
    {
        $resultsArr = $this->raceApiClient->getResults($sessionKey);
        foreach ($resultsArr as $item) {
            $raceData = [
                'driver_number' => $item['driver_number'],
                'lap_number' => $item['lap_number'],
                'duration_sector_1' => $item['duration_sector_1'],
                'duration_sector_2' => $item['duration_sector_2'],
                'duration_sector_3' => $item['duration_sector_3'],
            ];
            $this->raceRepository->create($raceData);
        }
    }

    public function getRaceData(GetRaceDataDTO $raceDataDTO): array
    {
        $raceData = $this->raceRepository->getRaceData($raceDataDTO->driverNumbers, $raceDataDTO->lapRange);

        $result = match ($raceDataDTO->duration) {
            '1' => $raceData
                ->map(fn (Race $item) => "lap $item->lap_number: '$item->driver_number': $item->duration_sector_1"),
            '2' => $raceData
                ->map(fn (Race $item) => "lap $item->lap_number: '$item->driver_number: $item->duration_sector_2"),
            '3' => $raceData
                ->map(fn (Race $item) => "lap $item->lap_number: '$item->driver_number': $item->duration_sector_3"),
            default => $raceData
                ->map(fn (Race $item) => "lap $item->lap_number: '$item->driver_number': $item->duration_lap")
        };
        return $result->toArray();
    }
}