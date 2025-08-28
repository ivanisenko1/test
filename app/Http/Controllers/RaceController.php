<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTOs\Race\GetRaceDataDTO;
use App\Http\Requests\Race\GetResultRaceRequest;
use App\Services\RaceService;
use Illuminate\Http\JsonResponse;

class RaceController extends Controller
{
    /**
     * @param RaceService $raceService
     */
    public function __construct(protected RaceService $raceService)
    {
    }

    /**
     * @param int $sessionKey
     * @return void
     */
    public function saveResults(int $sessionKey): JsonResponse
    {
        $this->raceService->parseResults($sessionKey);
        return response()->json([
            'message' => 'successfully'
        ]);
    }

    /**
     * @param GetResultRaceRequest $raceRequest
     * @return JsonResponse
     */
    public function getGroupedData(GetResultRaceRequest $raceRequest): JsonResponse
    {
        return response()->json(
            $this->raceService->getRaceData(GetRaceDataDTO::fromArray($raceRequest->validated()))
        );
    }
}
