<?php
/**
 * Created by PhpStorm.
 * User: Vector
 * Date: 23/01/2018
 * Time: 15:56
 */

namespace App\Criteria;


interface CriteriaTrashedInterface
{
    public function onlyTrashed();
    public function withTrashed();
}