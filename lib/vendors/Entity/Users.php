<?php
/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 10/11/2017
 * Time: 14:39
 */

namespace Entity;

use \framework\Entity;


class Users extends Entity
{
    /**
     * User id.
     * @var integer
     */
    protected $id;

    /**
     * User name.
     * @var string
     */
    protected $username;


    /**
     * User Password.
     * @var string
     */
    protected $password;

    /**
     * Salt that was originally used to encode the password
     * @var string
     */
    protected $salt;

    /**
     * User role.
     * Values : Subscriber or Admin
     * @var string
     */
    protected $rights;

    const USERNAME_INVALID = 1;
    const PASSWORD_INVALID = 2;
    const SALT_INVALID = 3;
    const RIGHTS_INVALID = 4;


    public function isValid()
    {
        return !(empty($this->username) || empty($this->password) || empty($this->salt) || empty($this->rights));
    }

    // GETTERS //
    public function id()
    {
        return $this->id;
    }

    public function username()
    {
        return $this->username;
    }

    public function password()
    {
        return $this->password;
    }

    public function salt()
    {
        return $this->salt;
    }

    public function rights()
    {
        return $this->rights;
    }

    // SETTERS //
    public function setId($id)
    {
        if (is_integer($id) && $id > 0) {
            $this->id = $id;
        }
    }

    public function setUsername($username)
    {
        if (!is_string($username) || empty($username) || strlen($username) > 50) {
            $this->erreurs[] = self::USERNAME_INVALID;
        }

        $this->username = $username;
    }

    public function setPassword($password)
    {
        if (!is_string($password) || empty($password)) {
            $this->erreurs[] = self::PASSWORD_INVALID;
        }

        $this->password = $password;
    }

    public function setSalt($salt)
    {
        if (!is_string($salt) || empty($salt)) {
            $this->erreurs[] = self::SALT_INVALID;
        }

        $this->salt = $salt;
    }

    public function setRights($rights)
    {
        if (!is_string($rights) || empty($rights)) {
            $this->erreurs[] = self::RIGHTS_INVALID;
        }

        $this->rights = $rights;
    }



}