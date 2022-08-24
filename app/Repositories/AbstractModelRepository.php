<?php

namespace App\Repositories;

use App\Assets\SortBy;
use App\Models\AbstractModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Class for AbstractModelRepository
 * @package App\Repositories
 */
class AbstractModelRepository implements RepositoryInterface
{

    public function getResource(): AbstractModel
    {
        // TODO: Implement getResource() method.
    }

    public function setResource(AbstractModel $AbstractModel): RepositoryInterface
    {
        // TODO: Implement setResource() method.
    }

    public function isTrashedIncludedInSearch(): bool
    {
        // TODO: Implement isTrashedIncludedInSearch() method.
    }

    public function setTrashedIncludedInSearch(bool $trashedIncludedInSearch): RepositoryInterface
    {
        // TODO: Implement setTrashedIncludedInSearch() method.
    }

    public function getBuilder(array $search = [], SortBy $sortBy = null): Builder
    {
        // TODO: Implement getBuilder() method.
    }

    public function getById(int $id)
    {
        // TODO: Implement getById() method.
    }

    public function get(array $search = [], SortBy $sortBy = null): Collection
    {
        // TODO: Implement get() method.
    }

    public function paginate(array $search = [], int $rowsPerPage = 15, SortBy $sortBy = null, array $customParams = []): LengthAwarePaginator
    {
        // TODO: Implement paginate() method.
    }

    public function first(array $search = [])
    {
        // TODO: Implement first() method.
    }

    public function store(array $data = null): AbstractModel
    {
        // TODO: Implement store() method.
    }

    public function update(AbstractModel $model, array $data = null, bool $restore = false): AbstractModel
    {
        // TODO: Implement update() method.
    }

    public function destroy(AbstractModel $model): bool
    {
        // TODO: Implement destroy() method.
    }
}
