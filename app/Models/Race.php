<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property int $driver_number
 * @property int $lap_number
 * @property float $duration_sector_1
 * @property float $duration_sector_2
 * @property float $duration_sector_3
 * @property float $duration_lap
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Race extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var list<string>
     */
    protected $fillable = [
        'driver_number',
        'lap_number',
        'duration_sector_1',
        'duration_sector_2',
        'duration_sector_3',
    ];

    /**
     * @return Attribute
     */
    protected function durationLap(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attributes) => $attributes['duration_sector_1'] +
                $attributes['duration_sector_2'] +
                $attributes['duration_sector_3'],
        );
    }
}
