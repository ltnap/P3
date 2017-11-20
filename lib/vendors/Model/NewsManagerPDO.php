<?php

/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 02/11/2017
 * Time: 20:02
 */

namespace Model;

use \Entity\News;

class NewsManagerPDO extends NewsManager
{
    public function getList($debut, $limite)
    {
        $sql = 'SELECT id, auteur, titre, content, AddDate, UpdtDate FROM news ORDER BY id DESC';

        if ($debut != -1 || $limite != -1)
        {
            $sql .= ' LIMIT '. $limite.' OFFSET '. $debut;
        }

        $requete = $this->dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');

        $listeNews = $requete->fetchAll();

        foreach ($listeNews as $news)
        {
            $news->setAddDate(new \DateTime($news->AddDate()));
            $news->setUpdtDate(new \DateTime($news->UpdtDate()));
        }

        $requete->closeCursor();

        return $listeNews;
    }

    public function getAllNews()
    {
        $sql = 'SELECT id, auteur, titre FROM news ORDER BY id DESC';

        $requete = $this->dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');

        $listeAllNews = $requete->fetchAll();

        return $listeAllNews;
    }

    public function getUnique($id)
    {
        $requete = $this->dao->prepare('SELECT id, auteur, titre, content, AddDate, UpdtDate FROM news WHERE id = :id');
        $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $requete->execute();

        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');

        if ($news = $requete->fetch())
        {
            $news->setAddDate(new \DateTime($news->AddDate()));
            $news->setUpdtDate(new \DateTime($news->UpdtDate()));

            return $news;
        }

        return null;
    }

    public function count()
    {
        return $this->dao->query('SELECT COUNT(*) FROM news')->fetchColumn();
    }

    protected function add(News $news)
    {
        $requete = $this->dao->prepare('INSERT INTO news SET auteur = :auteur, titre = :titre, content = :content, AddDate = NOW(), UpdtDate = NOW()');

        $requete->bindValue(':titre', $news->titre());
        $requete->bindValue(':auteur', $news->auteur());
        $requete->bindValue(':content', $news->content());

        $requete->execute();
    }

    protected function modify(News $news)
    {
        $requete = $this->dao->prepare('UPDATE news SET auteur = :auteur, titre = :titre, content = :content, UpdtDate = NOW() WHERE id = :id');

        $requete->bindValue(':titre', $news->titre());
        $requete->bindValue(':auteur', $news->auteur());
        $requete->bindValue(':content', $news->content());
        $requete->bindValue(':id', $news->id(), \PDO::PARAM_INT);

        $requete->execute();
    }

    public function delete($id)
    {
        $this->dao->exec('DELETE FROM news WHERE id = '.(int) $id);
    }
}