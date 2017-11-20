<?php
/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 03/11/2017
 * Time: 09:02
 */

namespace Entity;


use framework\Entity;

class Comment extends Entity
{
    protected $news,
        $auteur,
        $content,
        $state,
        $date;

    const AUTEUR_INVALIDE = 1;
    const CONTENU_INVALIDE = 2;

    public function isValid()
    {
        return !(empty($this->auteur) || empty($this->content));
    }

    public function setNews($news)
    {
        $this->news = (int) $news;
    }

    public function setAuteur($auteur)
    {
        if (!is_string($auteur) || empty($auteur))
        {
            $this->erreurs[] = self::AUTEUR_INVALIDE;
        }

        $this->auteur = $auteur;
    }

    public function setContent($content)
    {
        if (!is_string($content) || empty($content))
        {
            $this->erreurs[] = self::CONTENU_INVALIDE;
        }

        $this->content = $content;
    }

    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }

    public function setState($state)
    {
//        $state = (int) $state;

        $this->state = (int) $state;
    }




    public function news()
    {
        return $this->news;
    }

    public function auteur()
    {
        return $this->auteur;
    }

    public function content()
    {
        return $this->content;
    }

    public function state()
    {
        return  $this->state;
    }

    public function date()
    {
        return $this->date;
    }

}