<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FindByTitle
 * @package App\Criteria
 */
class FindByTitleCriteria implements CriteriaInterface
{
    /**
     * @var
     */
    private $title;

    /**
     * FindByTitle constructor.
     * @param $title
     */
    public function __construct($title)
    {
        $this->title = $title;
    }

    /**
     * Apply criteria in query repository
     *
     * @param $model
     * @param RepositoryInterface $repository
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('title', 'LIKE', "%{$this->title}%")->orWhere('name', 'LIKE', "%{$this->title}%");
    }


}