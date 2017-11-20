<?php

/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 12/11/2017
 * Time: 17:12
 */

namespace App\Backend\Modules\Users;


use \framework\BackController;
use \framework\HTTPRequest;
use \Entity\Users;
use \Forms\FormBuilders\NewsFormBuilder;
use \Forms\FormHandler;


class UsersController extends BackController
{
    public function executeIndex(HTTPRequest $request)
    {
        $manager = $this->managers->getManagerOf('Users');

        $this->page->addVar('title', 'Les Utilisateurs');

        $this->page->addVar('allUsersList', $manager->getAllUsers());
        $this->page->addVar('nombreUsers', $manager->count());
    }

    public function executeDeleteUser(HTTPRequest $request)
    {
        $this->managers->getManagerOf('Users')->delete($request->getData('id'));

        $this->app->user()->setFlash('INFO','L\'utilisateur a bien été supprimé', 'success');

        $this->app->httpResponse()->redirect('/admin/users/');

    }

    public function executeModifyRights(HTTPRequest $request)
    {
        $this->managers->getManagerOf('Users')->modifyUsersRights($request->getData('id'));

        $this->app->user()->setFlash('INFO','Les droits de l\'utilisateur ont été changés', 'success');

        $this->app->httpResponse()->redirect('/admin/users/');
    }
}