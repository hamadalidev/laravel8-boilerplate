<?php

namespace App\Services;

use App\Assets\SortBy;
use App\Common\Helpers\DataHelper;
use App\Common\Helpers\ExceptionHelper;
use App\Http\Requests\AbstractFormRequest;
use App\Models\AbstractModel;
use App\Repositories\AbstractModelRepository;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Class for abstract service
 * @package App\Services
 */
class AbstractService implements ServiceInterface
{

    use DataHelper, ExceptionHelper;

    /**
     * @var AbstractFormRequest
     */
    protected $request;

    /**
     * @var Guard
     */
    protected $auth;

    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * UserService constructor.
     *
     * @param AbstractFormRequest $request
     * @param Guard               $auth
     * @param RepositoryInterface $repository
     */
    public function __construct(AbstractFormRequest $request, Guard $auth, RepositoryInterface $repository)
    {
        $this->request    = $request;
        $this->auth       = $auth;
        $this->repository = $repository;
    }

    /**
     * @return AbstractFormRequest
     */
    public function getRequest(): AbstractFormRequest
    {
        return $this->request;
    }

    /**
     * @param string $id
     *
     * @return AbstractModel
     */
    public function getById(string $id): AbstractModel
    {
        return $this->repository->getById($id);
    }

    /**
     * @param array       $filters
     * @param SortBy|null $sortBy
     *
     * @return Collection
     */
    public function all(array $filters = [], SortBy $sortBy = null): Collection
    {
        return $this->repository->get($this->initCollectionFilters($filters), $sortBy);
    }

    /**
     * @param array       $filters
     * @param int         $rowsPerPage
     * @param SortBy|null $sortBy
     * @param array       $customParams
     *
     * @return LengthAwarePaginator
     */
    public function paginate(array $filters = [], int $rowsPerPage = 15, SortBy $sortBy = null, array $customParams = []): LengthAwarePaginator
    {
        return $this->repository->paginate($this->initCollectionFilters($filters), $rowsPerPage, $sortBy, $customParams);
    }

    /**
     * @return AbstractModel
     */
    public function show(): AbstractModel
    {
        return $this->request->getModel();
    }

    /**
     * @return AbstractModel
     */
    public function store(): AbstractModel
    {
        abort(403, 'Unauthorized action.');
    }

    /**
     * @param bool $restore
     *
     * @return AbstractModel
     */
    public function update($restore = false): AbstractModel
    {
        abort(403, 'Unauthorized action.');
    }

    /**
     * @return bool
     */
    public function destroy(): bool
    {
        return $this->repository->destroy($this->request->getModel());
    }

    /**
     * @param array $filters
     *
     * @return array
     */
    protected function initCollectionFilters(array $filters = []): array
    {
        return $filters;
    }
}
