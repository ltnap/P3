<?php
/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 17/11/2017
 * Time: 18:57
 */

namespace App\Api;

use framework\Application;

class ApiApplication extends Application
{
    public function __construct()
    {
        parent::__construct();

        $this->name = 'Api';
    }

    public function run()
    {
        $controller = $this->getController();
        $controller->execute();
        $this->httpResponse->setPage($controller->page());
        $this->httpResponse->send();
    }
}