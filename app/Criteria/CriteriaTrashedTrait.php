<?php
/**
 * Created by PhpStorm.
 * User: Vector
 * Date: 23/01/2018
 * Time: 15:55
 */

namespace App\Criteria;


trait CriteriaTrashedTrait {

    public function onlyTrashed(){
        $this->pushCriteria(FindOnlyTrashedCriteria::class);
        return $this;
    }

    public function withTrashed(){
        $this->pushCriteria(FindWithTrashedCriteria::class);
        return $this ;
    }
}