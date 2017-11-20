<?php
/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 01/11/2017
 * Time: 15:05
 */

namespace App\Frontend;


use framework\Application;

class FrontendApplication extends Application
{

    public function __construct()
    {
        parent::__construct();

        $this->name = 'Frontend';
    }

    public function run()
    {
        // Obtention du controleur grâce à la méthode parente getController()
        $controller = $this->getController();

        // Exécution du contrôleur
        $controller->execute();

        // Assignation de la page créée par le contrôleur à la réponse
        $this->httpResponse->setPage($controller->page());

        // Envoi de la réponse
        $this->httpResponse->send();
    }

}