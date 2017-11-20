<?php

/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 03/11/2017
 * Time: 14:19
 */

namespace App\Backend;

use \framework\Application;

class BackendApplication extends Application
{
    public function __construct()
    {
        parent::__construct();

        $this->name = 'Backend';
    }

    public function run()
    {
        if ($this->user->isAdmin())
        {
            $controller = $this->getController();
            $controller->execute();
            $this->httpResponse->setPage($controller->page());
            $this->httpResponse->send();
        }
        elseif ($this->user->isSubscriber())
        {
            $this->user->setFlash( 'ERREUR','Désolé, vous n\'avez pas d\'autorisation pour accéder à l\'espace d\'administration', 'danger' );
            $this->httpResponse()->redirect('/');
        }
        else
        {
            $this->httpResponse()->redirect('/auth/login.html');
        }




    }
}