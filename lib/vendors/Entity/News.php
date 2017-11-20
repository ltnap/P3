<?php

/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 02/11/2017
 * Time: 20:02
 */

namespace Entity;

use \framework\Entity;

class News extends Entity
{
    protected $auteur,
            $titre,
            $content,
            $AddDate,
            $UpdtDate;

    const AUTEUR_INVALIDE = 1;
    const TITRE_INVALIDE = 2;
    const CONTENT_INVALIDE = 3;

    public function isValid()
    {
        return !(empty($this->auteur) || empty($this->titre) || empty($this->content));
    }


    // SETTERS //

    public function setAuteur($auteur)
    {
        if (!is_string($auteur) || empty($auteur))
        {
            $this->erreurs[] = self::AUTEUR_INVALIDE;
        }

        $this->auteur = $auteur;
    }

    public function setTitre($titre)
    {
        if (!is_string($titre) || empty($titre))
        {
            $this->erreurs[] = self::TITRE_INVALIDE;
        }

        $this->titre = $titre;
    }

    public function setContent($content)
    {
        if (!is_string($content) || empty($content))
        {
            $this->erreurs[] = self::CONTENT_INVALIDE;
        }

        $this->content = $content;
    }

    public function setAddDate(\DateTime $AddDate)
    {
        $this->AddDate = $AddDate;
    }

    public function setUpdtDate(\DateTime $UpdtDate)
    {
        $this->UpdtDate = $UpdtDate;
    }

    // GETTERS //

    public function auteur()
    {
        return $this->auteur;
    }

    public function titre()
    {
        return $this->titre;
    }

    public function content()
    {
        return $this->content;
    }

    public function AddDate()
    {
        return $this->AddDate;
    }

    public function UpdtDate()
    {
        return $this->UpdtDate;
    }
}