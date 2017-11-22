<?php
/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 03/11/2017
 * Time: 09:02
 */

namespace Model;
use \Entity\Comment;


class CommentsManagerPDO extends CommentsManager
{
    protected function add(Comment $comment)
    {
        $q = $this->dao->prepare('INSERT INTO comments SET news = :news, auteur = :auteur, content = :content, state = 0, date = NOW()');

        $q->bindValue(':news', $comment->news(), \PDO::PARAM_INT);
        $q->bindValue(':auteur', $comment->auteur());
        $q->bindValue(':content', $comment->content());

        $q->execute();

        $comment->setId($this->dao->lastInsertId());
    }

    public function getAllComments()
    {

        $sql = 'SELECT * FROM comments ORDER BY date DESC';

        $requete = $this->dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

        $listReportComments = $requete->fetchAll();

        $requete->closeCursor();

        return $listReportComments;
    }

    public function getListOf($news)
    {
        if (!ctype_digit($news))
        {
            throw new \InvalidArgumentException('L\'identifiant de la news passé doit être un nombre entier valide');
        }

        $q = $this->dao->prepare('SELECT * FROM comments WHERE news = :news');
        $q->bindValue(':news', $news, \PDO::PARAM_INT);
        $q->execute();

        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

        $comments = $q->fetchAll();

        foreach ($comments as $comment)
        {
            $comment->setDate(new \DateTime($comment->date()));
        }

        return $comments;
    }

    protected function modify(Comment $comment)
    {
        $q = $this->dao->prepare('UPDATE comments SET auteur = :auteur, content = :content, state = :state WHERE id = :id');

        $q->bindValue(':auteur', $comment->auteur());
        $q->bindValue(':content', $comment->content());
        $q->bindValue(':state', $comment->state());
        $q->bindValue(':id', $comment->id(), \PDO::PARAM_INT);

        $q->execute();
    }

    public function get($id)
    {
        $q = $this->dao->prepare('SELECT * FROM comments WHERE id = :id');
        $q->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $q->execute();

        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

        return $q->fetch();
    }

    public function delete($id)
    {
        $this->dao->exec('DELETE FROM comments WHERE id = '.(int) $id);
    }

    public function deleteFromNews($newsId)
    {
        $this->dao->exec('DELETE FROM comments WHERE news = '.(int) $newsId);
    }

    public function count()
    {
        return $this->dao->query('SELECT COUNT(*) FROM comments')->fetchColumn();
    }

    public function getListReportComments()
    {
        $sql = 'SELECT * FROM comments WHERE state > 0';

        $requete = $this->dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

        $listReportComments = $requete->fetchAll();

        $requete->closeCursor();

        return $listReportComments;
    }

    public function countReportComments()
    {
        return $this->dao->query('SELECT COUNT(*) FROM comments WHERE state > 0 ')->fetchColumn();
    }
}