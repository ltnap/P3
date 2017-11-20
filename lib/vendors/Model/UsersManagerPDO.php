<?php
/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 10/11/2017
 * Time: 17:10
 */

namespace Model;

use \Entity\Users;


class UsersManagerPDO extends UsersManager
{
    protected function add(Users $user)
    {
        $requete = $this->dao->prepare('INSERT INTO users SET username = :username, password = :password, salt = :salt, rights = :rights');

        $requete->bindValue(':username', $user->username());
        $requete->bindValue(':password', $user->password());
        $requete->bindValue(':salt', $user->salt());
        $requete->bindValue(':rights', $user->rights());

        $requete->execute();
    }

    public function getAllUsers()
    {
        $sql = 'SELECT * FROM users ORDER BY username ASC';

        $requete = $this->dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Users');

        $listAllUsers = $requete->fetchAll();

        return $listAllUsers;
    }

    public function count()
    {
        return $this->dao->query('SELECT COUNT(*) FROM users')->fetchColumn();
    }

    protected function modify(Users $user)
    {
        $requete = $this->dao->prepare('UPDATE users SET id = :id, username = :username, password = :password, salt = salt, rights = :rights WHERE id = :id');

        $requete->bindValue(':username', $user->username());
        $requete->bindValue(':password', $user->password());
        $requete->bindValue(':salt', $user->salt());
        $requete->bindValue(':rights', $user->rights());
        $requete->bindValue(':id', $user->id(), \PDO::PARAM_INT);

        $requete->execute();
    }

    public function delete($id)
    {
        $this->dao->exec('DELETE FROM users WHERE id = '.(int) $id);
    }

    public function getByUserId($id)
    {
        $requete = $this->dao->prepare('SELECT * FROM users WHERE id = :id');

        $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $requete->execute();

        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Users');

        return $requete->fetch();

    }

    /**
     * Get a user by the username
     * @param string $username
     * @return mixed
     */
    public function getByUsername($username)
    {
        $q = $this->dao->prepare('SELECT * FROM users WHERE username = :username');

        $q->bindValue(':username', $username);
        $q->execute();

        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Users');

        return $q->fetch();
    }

    public function modifyUsersRights($id)
    {
        $user = $this->getByUserId($id);

        if($user->rights() == 'ADMIN')
        {
            $user->setRights('SUBSCRIBER');
            $this->save($user);

        }
        elseif($user->rights() == 'SUBSCRIBER')
        {
            $user->setRights('ADMIN');
            $this->save($user);
            $_SESSION['rights'] = 'ADMIN';
        }
    }

    public function userNameExist($id, $username)
    {
        $requete = $this->dao->prepare('SELECT * FROM users WHERE username = :username AND id != :id');

        $requete->bindValue('username', $username);
        $requete->bindValue('id', $id);

        $requete->execute();

        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Users');

        if(empty($requete->fetch()))
        {
            return true;
        }
        else
        {
            return false;
        }
    }


}