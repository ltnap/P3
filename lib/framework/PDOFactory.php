<?php
/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 31/10/2017
 * Time: 16:27
 */

namespace framework;


class PDOFactory
{
    public static function getMysqlConnexion()
    {
        $db = new \PDO('mysql:host=localhost;dbname=blog', 'root', '');
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $db;
    }
}