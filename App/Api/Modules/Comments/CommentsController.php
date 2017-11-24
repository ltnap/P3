<?php

/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 10/11/2017
 * Time: 11:25
 */

namespace App\Api\Modules\Comments;

use \framework\BackController;
use \framework\HTTPRequest;
use \Entity\Comment;
use \Forms\FormBuilders\CommentFormBuilder;
use \Forms\FormHandler;


class CommentsController extends BackController
{
    public function executeInsertComment(HTTPRequest $request)
    {
        // Si le formulaire a été envoyé, on crée le commentaire avec les valeurs du formulaire.
        if ($request->method() == 'POST')
        {

            $comment = new Comment([
                'news' => $request->getData('news'),
                'auteur' => $request->postData('auteur'),
                'content' => $request->postData('content'),
                'state' => $request->postData('state')
            ]);
        }
        else
        {
            $comment = new Comment;
        }

        $formBuilder = new CommentFormBuilder($comment);
        $formBuilder->build();
        $form = $formBuilder->form();
        $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);
        if ($formHandler->process())
        {
            $this->app->user()->setFlash('INFO','Le commentaire a bien été ajouté', 'success');
            $this->app->httpResponse()->redirect('/api/get-news-' .$comment->news() .'#3rdPage/1');

        }

        $this->page->addVar('comment', $comment);
        $this->page->addVar('form', $form->createView());
        $this->page->addVar('title', 'Ajout d\'un commentaire');
    }

    public function executeReportComment( HTTPRequest $request )
    {
        $commentId = $request->getData( 'id' );
        $comment   = $this->managers->getManagerOf( 'Comments' )->get( $commentId );

        $state = $comment['state'];
        $state++;
        $comment->setState($state);

        $this->managers->getManagerOf( 'Comments' )->save($comment);

        $this->app->user()->setFlash( 'INFO','Le commentaire a bien été signalé', 'warning' );
        $this->app->httpResponse()->redirect( '/api/get-news-' .$comment->news() .'#3rdPage/1' );
    }
}