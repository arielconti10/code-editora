<?php

namespace App\Repositories;

use App\Criteria\CriteriaTrashedInterface;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CategoryRepository.
 *
 * @package namespace App\Repositories;
 */
interface CategoryRepository extends
    RepositoryInterface,
    RepositoryCriteriaInterface,
    CriteriaTrashedInterface,
    RepositoryRestoreInterface
{
    public function pluckWithMutators($column, $key = null);
}
