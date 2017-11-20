<?php
/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 17/11/2017
 * Time: 19:00
 */


namespace App\Api\Modules\News;

use \framework\BackController;
use \framework\HTTPRequest;

class NewsController extends BackController
{
    public function executeShow(HTTPRequest $request)
    {
        $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));

        if (empty($news))
        {
            $this->app->httpResponse()->redirect404();
        }

        $this->page->addVar('title', $news->titre());
        $this->page->addVar('news', $news);
        $this->page->addVar('comments', $this->managers->getManagerOf('Comments')->getListOf($news->id()));
    }


}