<?php
/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 06/11/2017
 * Time: 17:11
 */

namespace App\Backend\Modules\Comments;


use \framework\BackController;
use \Entity\Comment;
use \Forms\FormHandler;
use \Forms\FormBuilders\CommentFormBuilder;
use \framework\HTTPRequest;
use \Model\CommentsManager;
use \Model\CommentsManagerPDO;


class CommentsController extends BackController
{
    public function executeIndex(HTTPRequest $request)
    {
        // Titre pour la page index des commentaires

        $this->page->addVar('title', 'Gestion des commentaires');

        // Récupèration du manager des commentaires.
        $manager = $this->managers->getManagerOf('Comments');

        $this->page->addVar('comments', $manager->getAllComments());
        $this->page->addVar('nombreComs', $manager->count());
    }

    public function executeUpdateComment(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Modification d\'un commentaire');

        if ($request->method() == 'POST')
        {
            $comment = new Comment([
                'id' => $request->getData('id'),
                'auteur' => $request->postData('auteur'),
                'content' => $request->postData('content'),
                'state' => $request->getData('state')
            ]);
        }
        else
        {
            $comment = $this->managers->getManagerOf('Comments')->get($request->getData('id'));
        }

        $formBuilder = new CommentFormBuilder($comment);
        $formBuilder->build();

        $form = $formBuilder->form();

        $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);

        if ($formHandler->process())
        {
            $this->app->user()->setFlash('INFO','Le commentaire a bien été modifié', 'success');
            $this->app->httpResponse()->redirect('/admin/comments/');
        }

        $this->page->addVar('form', $form->createView());
    }

    public function executeDeleteComment(HTTPRequest $request)
    {
        $this->managers->getManagerOf('Comments')->delete($request->getData('id'));

        $this->app->user()->setFlash('INFO','Le commentaire a bien été supprimé !', 'success');

        $this->app->httpResponse()->redirect('/admin/comments/');
    }

}