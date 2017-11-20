<?php
/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 30/10/2017
 * Time: 17:41
 */

namespace framework;


class ApplicationComponent
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function app()
    {
        return $this->app;
    }
}