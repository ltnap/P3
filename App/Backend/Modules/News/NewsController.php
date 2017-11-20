<?php
/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 03/11/2017
 * Time: 16:16
 */

namespace App\Backend\Modules\News;


use \framework\BackController;
use \framework\HTTPRequest;
use \Entity\News;
use \Forms\FormBuilders\NewsFormBuilder;
use \Forms\FormHandler;

class NewsController extends BackController
{
    public function executeIndex(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Gestion des news');

        $manager = $this->managers->getManagerOf('News');

        $this->page->addVar('listeNews', $manager->getList(-1, -1));
        $this->page->addVar('nombreNews', $manager->count());
    }

    public function executeInsert(HTTPRequest $request)
    {
        $this->processForm($request);

        $this->page->addVar('title', 'Ajout d\'une news');
    }


    public function executeUpdate(HTTPRequest $request)
    {
        $this->processForm($request);

        $this->page->addVar('title', 'Modification d\'une news');
    }

    public function executeDelete(HTTPRequest $request)
    {
        if( $request->getExists( 'id' ) ) {
            $id = $request->getData( 'id');

        $this->managers->getManagerOf('News')->delete($request->getData('id'));
        $this->managers->getManagerOf('Comments')->deleteFromNews($id);

        $this->app->user()->setFlash('INFO','La news a bien été supprimée !', 'success');

        $this->app->httpResponse()->redirect('.');

        } else {
            $this->app->user()->setFlash( 'ERREUR','Aucun identifiant de chapitre n\a été transmis !','danger' );
        }
    }


    public function processForm(HTTPRequest $request)
    {
        if ($request->method() == 'POST')
        {
            $news = new News([
                'auteur' => $request->postData('auteur'),
                'titre' => $request->postData('titre'),
                'content' => $request->postData('content')
            ]);

            if ($request->getExists('id'))
            {
                $news->setId($request->getData('id'));
            }
        }
        else
        {
            // L'identifiant de la news est transmis si on veut la modifier
            if ($request->getExists('id'))
            {
                $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));
            }
            else
            {
                $news = new News;
            }
        }

        $formBuilder = new NewsFormBuilder($news);
        $formBuilder->build();

        $form = $formBuilder->form();

        $formHandler = new FormHandler($form, $this->managers->getManagerOf('News'), $request);

        if ($formHandler->process())
        {
            if($news->isNew())
            {
                $this->app->user()->setFlash('INFO','La news a bien été ajoutée', 'success');
            } else {
                $this->app->user()->setFlash( 'INFO','La news a bien été modifiée', 'success');
            }

            $this->app->httpResponse()->redirect('/admin/');
        }

        $this->page->addVar('form', $form->createView());
    }


}