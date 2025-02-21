<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class BaseRepository
{
    /**
     * @var Model The model instance
     */
    protected Model $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model The model instance
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get a new query builder instance for the model.
     *
     * @return Builder
     */
    public function query(): Builder
    {
        return $this->model::query();
    }

    /**
     * Retrieve all records of the model.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * Find a model by its primary key.
     *
     * @param int $id The ID of the model
     * @return Model|null
     */
    public function find(int $id): ?Model
    {
        return $this->query()->find($id);
    }

    /**
     * Find a model by its primary key or throw an exception.
     *
     * @param int $id The ID of the model
     * @return Model|null
     * @throws ModelNotFoundException
     */
    public function findOrFail(int $id): ?Model
    {
        return $this->query()->findOrFail($id);
    }

    /**
     * Create a new model instance with the given attributes.
     *
     * @param array $attributes The attributes to set on the model
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->query()->create($attributes);
    }

    /**
     * Update an existing model by its ID with given attributes.
     *
     * @param int $id The ID of the model to update
     * @param array $attributes The attributes to update
     * @return bool True if update was successful, false otherwise
     */
    public function update(int $id, array $attributes): bool
    {
        return (bool) $this->query()->where('id', $id)->update($attributes);
    }

    /**
     * Delete a model by its ID.
     *
     * @param int $id The ID of the model to delete
     * @return void
     */
    public function delete(int $id): void
    {
        $this->model->destroy($id);
    }

    /**
     * Paginate the model records.
     *
     * @param int $perPage Number of records per page
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->query()->paginate($perPage);
    }
}
