<?php

namespace App\Repositories;

use App\Assets\SortBy;
use App\Models\AbstractModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Interface RepositoryInterface
 * @package App\Contracts
 */
interface RepositoryInterface
{
    /**
     * gets the repository resource for all the queries
     *
     * @return AbstractModel
     */
    public function getResource(): AbstractModel;

    /**
     * sets the repository resource for all the queries
     *
     * @param AbstractModel $AbstractModel
     *
     * @return RepositoryInterface
     */
    public function setResource(AbstractModel $AbstractModel): RepositoryInterface;

    /**
     * gets whether or not is the trashed data included in search
     *
     * @return bool
     */
    public function isTrashedIncludedInSearch(): bool;

    /**
     * sets whether or not is the trashed data included in search
     *
     * @param bool $trashedIncludedInSearch
     *
     * @return RepositoryInterface
     */
    public function setTrashedIncludedInSearch(bool $trashedIncludedInSearch): RepositoryInterface;

    /**
     * @param array  $search
     * @param SortBy $sortBy
     *
     * @return Builder
     */
    public function getBuilder(array $search = [], SortBy $sortBy = null): Builder;

    /**
     * loads the model from the id value
     *
     * @param int $id
     *
     * @return AbstractModel|null
     */
    public function getById(int $id);

    /**
     * get a collection based on the search input
     *
     * @param array  $search
     * @param SortBy $sortBy
     *
     * @return Collection
     */
    public function get(array $search = [], SortBy $sortBy = null): Collection;

    /**
     * get a paginated collection based on the search input
     *
     * @param array  $search
     * @param int    $rowsPerPage
     * @param SortBy $sortBy
     * @param array  $customParams
     *
     * @return LengthAwarePaginator
     */
    public function paginate(array $search = [], int $rowsPerPage = 15, SortBy $sortBy = null, array $customParams = []): LengthAwarePaginator;

    /**
     * get the first matching model based on the search input
     *
     * @param array $search
     *
     * @return AbstractModel|null
     */
    public function first(array $search = []);

    /**
     * creates a new model
     *
     * @param array|null $data
     *
     * @return AbstractModel
     */
    public function store(array $data = null): AbstractModel;

    /**
     * updates the given model
     *
     * @param AbstractModel $model
     * @param array|null    $data
     * @param bool          $restore
     *
     * @return AbstractModel
     */
    public function update(AbstractModel $model, array $data = null, bool $restore = false): AbstractModel;

    /**
     * deletes the given model
     *
     * @param AbstractModel $model
     *
     * @return bool
     */
    public function destroy(AbstractModel $model): bool;
}
