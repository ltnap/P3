<?php
/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 31/10/2017
 * Time: 16:35
 */

namespace framework;


class Manager
{
    protected $dao;

    public function __construct($dao)
    {
        $this->dao = $dao;
    }
}