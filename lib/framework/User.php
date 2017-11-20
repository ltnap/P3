<?php
/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 01/11/2017
 * Time: 04:12
 */

namespace framework;

session_start();

class User
{
    public function getAttribute($attr)
    {
        return isset($_SESSION[$attr]) ? $_SESSION[$attr] : null;
    }





    public function setAttribute($attr, $value)
    {
        $_SESSION[$attr] = $value;
    }

    public function getFlash()
    {
        if(null !== ($flash = $_SESSION['flash'])){
            ?>
            <div id="alert" class="alert text-center alert-<?= $_SESSION['flash']['type']; ?>" role="alert" style="display: none;">
                <span><b><?= $_SESSION['flash']['title']?> | </b><?= $_SESSION['flash']['value']?></span>
            </div>
            <?php
        }
        unset($_SESSION['flash']);

        return $flash;
    }

    public function hasFlash()
    {
        return isset($_SESSION['flash']);
    }

    public function setFlash($title = 'ERREUR', $value, $type = 'danger')
    {
        $_SESSION['flash'] = array (
            'title' => $title,
            'value' => $value,
            'type' => $type
        );
    }



    public function setAuthenticated($authenticated)
    {
        if ($authenticated == true)
        {
        $_SESSION['auth'] = $authenticated;

        } elseif ($authenticated == false) {

        $_SESSION[ 'auth' ] = $authenticated;
        $_SESSION[ 'rights' ] = '';

        } else {
        throw new \InvalidArgumentException('La valeur spécifiée à la méthode User::setAuthenticated() doit être un boolean');
        }
    }

    public function isAuthenticated()
    {
        return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
    }

    /**
     * Verify if a ADMIN is logged
     * @return bool
     */
    public function isAdmin()
    {
        if( $this->isAuthenticated() ) {
            if( isset( $_SESSION[ 'auth' ] ) && $_SESSION[ 'auth' ] === true && isset( $_SESSION[ 'rights' ] ) && $_SESSION[ 'rights' ] === 'ADMIN' ) {
                return true;
            } else {
                return false;
            }
        }

    }

    /**
     * Verify if a USER is logged
     * @return bool
     */
    public function isSubscriber()
    {
        if( isset( $_SESSION[ 'auth' ] ) && $_SESSION[ 'auth' ] === true && isset( $_SESSION[ 'rights' ] ) && $_SESSION[ 'rights' ] === 'SUBSCRIBER' ) {
            return true;
        } else {
            return false;
        }
    }
}