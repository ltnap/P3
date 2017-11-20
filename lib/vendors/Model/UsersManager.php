<?php
/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 10/11/2017
 * Time: 16:56
 */

namespace Model;

use \Entity\Users;
use \framework\Manager;


abstract class UsersManager extends Manager
{
    /**
     * Insert a User in the BDD
     * @param $user Users The user to insert
     * @return void
     */
    abstract protected function add(Users $user);

    /**
     * Save the user in the BDD
     * @param \Entity\Users $user The chapter to save.
     * @see self::insert()
     * @see self::update()
     * @return void
     */
    public function save(Users $user)
    {
        if ($user->isValid())
        {
            $user->isNew() ? $this->add($user) : $this->modify($user);
        }
        else
        {
            throw new \RuntimeException('L\'utilisateur doit être validé pour être enregistré');
        }
    }

    /**
     * Return a list of all users, sorted by username
     * @return array A list of all users.
     */
    abstract public function getAllUsers();

    /**
     * Méthode renvoyant le nombre de news total.
     * @return int
     */
    abstract public function count();

    /**
     * Méthode permettant de modifier un utilisateur.
     * @param $user Users L'utilisateur à modifier
     * @return void
     */
    abstract protected function modify(Users $user);

    /**
     * Méthode permettant de supprimer un utilisateur.
     * @param $id int L'identifiant de l'utilisateur à supprimer
     * @return void
     */
    abstract public function delete($id);

    /**
     * Return a user matching the supplied id..
     * @param integer $id The user id.
     * @return \Entity\Users |throw an exception if no matching user is found
     */
    abstract public function getByUserId($id);


    /**
     * Get a user by the username
     * @param string $username
     * @return mixed
     */
    abstract public function getByUsername($username);

    /**
     * Méthode permettant d'intervertir le rôle de l'utilisateur entre USER  || ADMIN
     * @param $id integer User Id
     * @return void
     */
    abstract public function modifyUsersRights($id);

    abstract public function userNameExist($id, $username);
}