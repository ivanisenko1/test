<?php declare(strict_types=1);

namespace App\Repositories\Api;

use App\Models\Race;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * @extends BaseRepository<Race>
 */
class RaceRepository extends BaseRepository
{
    protected string $eloquent = Race::class;

    public function getRaceData(?array $driverNumbers, ?array $lapRange): Collection
    {
        $query = $this->model()->query()
            ->orderBy('driver_number')
            ->orderBy('lap_number');

        if (!is_null($driverNumbers)) {
            $query->whereIn('driver_number', $driverNumbers);
        }
        if (!is_null($lapRange)) {
            $query->whereBetween('lap_number', $lapRange);
        }

        return $query->get();
    }
}
