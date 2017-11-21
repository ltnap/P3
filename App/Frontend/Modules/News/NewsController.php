<?php

/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 02/11/2017
 * Time: 19:36
 */

namespace App\Frontend\Modules\News;

use \framework\BackController;
use \framework\HTTPRequest;

class NewsController extends BackController
{
    public function executeIndex(HTTPRequest $request)
    {
        $nbrNews = intval($this->app->config()->get('nombre_news_par_page'));
        $nbrCaracteres = $this->app->config()->get('nombre_caracteres_max');
        $nbrMaxBefAft = intval($this->app->config()->get('nbr_max_before_and_after'));


        // On ajoute une définition pour le titre.
        $this->page->addVar('title', 'Liste des '.$nbrNews.' dernières news');

        // On récupère le manager des news.
        $manager = $this->managers->getManagerOf('News');


        $nbrTotalNews = $manager->count();
        $nbrPages = intval(ceil($nbrTotalNews / $nbrNews));

        if ($request->getExists('page'))
        {
            $pageNum = intval($request->getData('page'));
        } else {
            $pageNum = 1;
        }

        if ($pageNum < 1)
        {
            $pageNum = 1;
        } elseif ($pageNum > $nbrPages)
        {
            $pageNum = $nbrPages;
        }

        $depart = intval(($pageNum - 1 ) * $nbrNews);


        $listeNews = $manager->getList($depart, $nbrNews);

        foreach ($listeNews as $news)
        {
            if (strlen($news->content()) > $nbrCaracteres)
            {
                $debut = substr($news->content(), 0, $nbrCaracteres);
                $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';

                $news->setContent($debut);
            }
        }

        // On ajoute la variable $listeNews à la vue.
        $this->page->addVar('listeNews', $listeNews);
        $this->page->addVar('nbrPages', $nbrPages);
        $this->page->addVar('pageNum', $pageNum);
        $this->page->addVar('nbrMaxBefAft', $nbrMaxBefAft);
    }

}