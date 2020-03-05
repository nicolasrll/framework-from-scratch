<?php

namespace Core;

/**
 * Used to get the database connexion as singleton
 * @author  Nicolas Rellier <nicolasrellier@yahoo.fr>
 */
class PdoConnect
{
    private static $pdo = null;
    //private static $instance = null;

    private function __construct()
    {
        $this->pdo = new \PDO('mysql:host=localhost; dbname=ffs', 'nicolas', 'Diabolo206!');
    }

    public static function getInstance()
    {

        if (is_null(self::$pdo)) {
            self::$pdo = new \PDO('mysql:host=localhost; dbname=ffs', 'nicolas', 'Diabolo206!');
        }
        return self::$pdo;

        /*
        if (is_null(self::$instance)) {
            self::$instance = new PdoConnect();
        }
        return self::$instance;
        */
    }
}
