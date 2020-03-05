<?php

namespace App\Repository;

use Core\PdoConnect;
use App\Entity\Article;
use App\Entity\Comment;

abstract class AbstractManager
{
    private $db = null;

    abstract public function getTableName();

    public function findOne(int $id)
    {
        if (is_null($this->db)) {
            $this->db = PdoConnect::getInstance();
        }
        $tableName = $this->getTableName();
        $request = $this->db->query('SELECT * FROM ' . $tableName . ' WHERE id = ' . $id);
        $data = $request->fetch(\PDO::FETCH_ASSOC);

        //return new Comment($data);
        return new Article($data);
    }


    public function findAll()
    {
        if (is_null($this->db)) {
            $this->db = PdoConnect::getInstance();
        }
        $articles = [];

        $tableName = $this->getTableName();
        $request = $this->db->query('SELECT * FROM ' . $tableName);

        while ($data = $request->fetch(\PDO::FETCH_ASSOC)) {
            /**
             *  En attendant de réussir à faire fonctionner l'appelle de class dynamique
             */
            //$articles[] = new Comment($data);
            $articles[] = new Article($data);
        }

        return $articles;
    }
}
