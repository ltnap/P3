<?php
/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 11/11/2017
 * Time: 19:15
 */

namespace App\Authentication;

use \framework\Application;

class AuthenticationApplication extends Application
{
    public function __construct()
    {
        parent::__construct();

        $this->name = 'Authentication';
    }

    public function run()
    {
        if ($this->user->isAuthenticated())
        {
            $controller = new Modules\Connexion\ConnexionController($this, 'Connexion', 'logout');
            $this->user()->setFlash('INFO','Vous êtes déconnecté', 'warning');

        } else {
            $controller = $this->getController();
        }

        $controller->execute();
        $this->httpResponse->setPage($controller->page());
        $this->httpResponse->send();
    }
}