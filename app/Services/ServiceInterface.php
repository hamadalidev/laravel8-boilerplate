<?php

namespace App\Services;

use App\Assets\SortBy;
use App\Http\Requests\AbstractFormRequest;
use App\Models\AbstractModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Interface ServiceInterface
 * @package App\Services
 */
interface ServiceInterface
{
    /**
     * @return AbstractFormRequest
     */
    public function getRequest(): AbstractFormRequest;

    /**
     * retrieve the model by id
     *
     * @param string $id
     *
     * @return AbstractModel
     */
    public function getById(string $id): AbstractModel;

    /**
     * gets all models
     *
     * @param array  $filters
     * @param SortBy $sortBy
     *
     * @return Collection
     */
    public function all(array $filters = [], SortBy $sortBy = null): Collection;

    /**
     * retrieve a paginated collection
     *
     * @param array  $filters
     * @param int    $rowsPerPage
     * @param SortBy $sortBy
     * @param array  $customParams
     *
     * @return LengthAwarePaginator
     */
    public function paginate(array $filters = [], int $rowsPerPage = 15, SortBy $sortBy = null, array $customParams): LengthAwarePaginator;

    /**
     * gets the request model
     *
     * @return AbstractModel
     */
    public function show(): AbstractModel;

    /**
     * creates a new model
     *
     * @return AbstractModel
     */
    public function store(): AbstractModel;

    /**
     * updates the request model
     *
     * @param bool $restore
     *
     * @return AbstractModel
     */
    public function update($restore = false): AbstractModel;

    /**
     * destroy the request model
     *
     * @return bool
     */
    public function destroy(): bool;
}
