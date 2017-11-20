<?php
/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 03/11/2017
 * Time: 15:24
 */


namespace App\Authentication\Modules\Connexion;

use \framework\BackController;
use \framework\HTTPRequest;
use \Entity\Users;
use \Forms\FormBuilders\LoginFormBuilder;
use \Forms\FormHandler;

class ConnexionController extends BackController
{
    public function executeLogin(HTTPRequest $request)
    {
        $this -> page -> addVar ( 'title' , 'CONNEXION' );

        $this->processFormLogin($request);
    }


    public function processFormLogin( HTTPRequest $request )
    {
        if( $request->method() == 'POST' ) {
            $user = new Users( [
                'username' => $request->postData( 'username' ),
                'password' => $request->postData( 'password' )
            ] );

            $manager = $this->managers->getManagerOf('Users')->getByUsername($request->postData('username'));

            if(!empty($manager)) {
                // On récupère la clé de salage en BDD
                $salt = $manager['salt'];
                // On récupère le hashage en BDD
                $hash = $manager['password'];

                // On récupère le mdp du formulaire de connexion
                $pass = $request->postData('password');

                if($hash == sha1($pass . $salt))
                {
                    $user = $manager;

                    $this->app->user()->setAuthenticated(true);
                    $_SESSION['rights'] = $manager->rights();
                    $this->app->user()->setFlash('INFO','Connexion réussie', 'success');
                    $this->app->httpResponse()->redirect('/admin/');
                }
                else
                {
                    $erreurs = 'Votre mot de passe ne correspond pas';
                }
            }
            else
            {
                $erreurs = 'Votre nom d\'utilisateur est incorrect';
            }
        }
        else
        {
            $user = new Users();
        }

        $formBuilder = new LoginFormBuilder($user);
        $formBuilder->build();
        $form        = $formBuilder->form();

        // Si une erreur a été générée, on l'envoie à la page
        if(isset($erreurs)) {
            $this->page->addVar( 'erreurs', $erreurs );
        }

        if(!empty($user)) {
            $this->page->addVar('user', $user);
        }
        // On envoie le formulaire à la page
        $this->page->addVar('form', $form->createView());

    }



    public function executeRegister(HTTPRequest $request)
    {
        $this->page->addVar('title', 'S\'INSCRIRE');

        $this->processFormRegister($request);
    }

    public function processFormRegister(HTTPRequest $request)
    {
        if( $request->method() == 'POST' )
        {
            $user = new Users( array(
                'username' => $request->postData( 'username' ),
                'password' => $request->postData( 'password')

            ));

            // On vérifie que le username est disponible
            $manager = $this->managers->getManagerOf('Users')->getByUsername($request->postData('username'));

            $username = $request->postData('username');

            if(isset($username) && !empty($username)) // Si le username n'existe pas en BDD
            {
                if($user->isNew())
                {
                    // On force le role utilisateur à USER
                    $user->setRights('SUBSCRIBER');
                    // On génère une clé de salage
                    $user->setSalt(substr(md5(time()), 0, 23));
                }

                $mdpForm = $request->postData('password');

                if(isset($mdpForm) && !empty($mdpForm))
                {
                    $pass = sha1($mdpForm . $user->salt());
                    $user->setPassword($pass);
                }
                else
                {
                    $erreurs = 'Veuillez entrer un mot de passe valide';
                    $this->app->httpResponse()->redirect( '/auth/register.html' );
                }
            }
            else // Le username est présent dans la BDD
            {
                $erreurs = 'Ce nom d\'utilisateur a déjà été utilisé';
                $this->app->httpResponse()->redirect( '/auth/register.html' );
            }
        }
        else
        {
            $user = new Users();
        }


        $formBuilder = new LoginFormBuilder($user);
        $formBuilder->build();
        $form = $formBuilder->form();

        $formHandler = new FormHandler($form, $this->managers->getManagerOf('Users'), $request);

        if ($formHandler->process())
        {
            if($user->isNew())
            {
                $this->app->user()->setFlash('INFO','Inscription Réussie', 'success');
            } else {
                $this->app->user()->setFlash('INFO','Utilisateur modifié avec succès', 'success');
            }

            $user->isNew() ? $this->app->httpResponse()->redirect('/') : $this->app->httpResponse()->redirect('/admin/');
        }

        // Si une erreur a été générée, on l'envoie à la page
        if(isset($erreurs)) {
            $this->page->addVar( 'erreurs', $erreurs );
        }

        // On envoie le formulaire à la page
        $this->page->addVar('form', $form->createView());


    }

    /**
     * Logout Controller
     * @param HTTPRequest $request
     */
    public function executeLogout(HTTPRequest $request)
    {
        $this->app->user()->setAuthenticated(false);
        $this->app->httpResponse()->redirect('/');
        $this->app->user()->setFlash('INFO','Vous êtes déconnecté', 'warning');
    }
}