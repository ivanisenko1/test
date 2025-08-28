<?php

namespace App\Clients;

class RaceApiClient
{
    public function getResults(int $sessionKey): array
    {
        $response = file_get_contents("https://api.openf1.org/v1/laps?session_key={$sessionKey}");
        return json_decode($response, true);
    }
}