<?php declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @template TModel of Model
 */
abstract class BaseRepository
{
    /**
     * @var class-string <T-Model>
     */
    protected string $eloquent;

    /**
     * @return TModel
     */
    protected function model(): Model
    {
        return (new $this->eloquent);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model()->get();
    }

    /**
     * @param int $id
     * @return TModel|null
     */
    public function getById(int $id): ?Model
    {
        return $this->model()
            ->where('id', '=', $id)
            ->first();
    }
    /**
     * @param array $params
     * @return TModel
     */
    public function create(array $params): Model
    {
        return $this->model()->create($params);
    }

    /**
     * @param TModel $model
     * @param array $params
     * @return bool
     */
    public function update(Model $model, array $params): bool
    {
        return $model->update($params);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return (bool) $this->model()
            ->where('id', '=', $id)
            ->delete();
    }
}
