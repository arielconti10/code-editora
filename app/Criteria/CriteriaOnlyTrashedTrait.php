<?php
/**
 * Created by PhpStorm.
 * User: Vector
 * Date: 23/01/2018
 * Time: 15:55
 */

namespace App\Criteria;


trait CriteriaOnlyTrashedTrait {

    public function onlyTrashed(){
        $this->pushCriteria(FindOnlyTrashedCriteria::class);
        return $this;
    }
}