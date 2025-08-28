<?php

namespace App\DTOs\Race;

class GetRaceDataDTO
{
    public function __construct(
        public readonly ?array $driverNumbers,
        public readonly ?array $lapRange,
        public readonly ?string $duration,
    ) {}

    public static function fromArray(array $data): self {
        return new self(
            $data['driverNumbers'] ?? null,
                self::parseLapRange($data['lapRange'] ?? null),
            $data['duration'] ?? null,
        );
    }

    public static function parseLapRange(?string $lapRange): ?array
    {
        return $lapRange ? explode('-', $lapRange) : null;
    }
}