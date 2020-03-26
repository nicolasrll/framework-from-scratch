<?php

namespace Core;

use Core\PdoConnect;
use App\Entity\Article;
use App\Entity\Comment;

abstract class AbstractManager
{
    abstract public function getTableName();

    public function findOne(int $id)
    {

        $pdo = PdoConnect::getInstance();

        $tableName = $this->getTableName();
        $request = $pdo->query('SELECT * FROM ' . $tableName . ' WHERE id = ' . $id);
        $data = $request->fetch();

        return $data;
    }


    public function findAll()
    {
        $pdo = PdoConnect::getInstance();
        $articles = [];

        $tableName = $this->getTableName();
        $requestSql = 'SELECT * FROM ' . $tableName;
        $stmt = $pdo->prepare($requestSql);
        $stmt->execute();
        $lines = $stmt->fetchAll();
        foreach ($lines as $line) {
            $result[] = $line;
        }
        //die();
        /*
        $request = $pdo->query('SELECT * FROM ' . $tableName);
        while ($data = $request->fetch(\PDO::FETCH_ASSOC)) {
            $result[] = $data;
        }
        */

        return $result;
    }

    function search(array $args)
    {
        $keys = \array_keys($args);
        $tableName = $this->getTableName();
        $requestSql = 'SELECT * FROM ' . $tableName . ' WHERE 1=1';
        $result = [];

        for ($i = 0; $i < count($args); $i++) {
            $requestSql .= ' AND ' . $keys[$i] . ' = ' . $args[$keys[$i]];
        }

        $pdo = PdoConnect::getInstance();
        $request = $pdo->query($requestSql);
        /*
        $request = $pdo->prepare($requestSql);
        for ($i = 0; $i < count($args); $i++) {
            $request->bindValue(':' . $keys[$i], $args[$keys[$i]]);
        }
        */

        while ($data = $request->fetch(\PDO::FETCH_ASSOC)) {
            //$result[] = new $tableName($data);
            $result[] = $data;
        }

        return $result;
    }

    public function find($filter = null)
    {
        if (is_numeric($filter)) {
            // On return findOne($filter)
            return $this->findOne($filter);
        }
        if (is_array($filter) && !empty($filter)) {
            // On return search
            return $this->search($filter);
        }
        // Sinon on return findAll
        return $this->findAll();
    }

    public function add(AbstractEntity $entity) {
        $properties = $entity->convertToArray();
        $columns = array_keys($properties);
        $columns = implode(',', $columns);
        $values = array_values($properties);
        $markers = array_fill(1, count($properties), '?');
        $markers = implode(',', $markers);

        $tableName = $this->getTableName();
        $pdo = PdoConnect::getInstance();
        $sql = 'INSERT INTO ' . $tableName . '('.$columns . ') VALUES (' . $markers . ')';
        $stmt = $pdo->prepare($sql);
        $stmt->execute($values);
    }

    public function update(AbstractEntity $entity, $idArticle) {
        // Used before using the id in the url in the WHERE
        //$id = $entity->getId();

        $properties = $entity->convertToArray();
        $keys = array_keys($properties);
        $values = array_values($properties);
        $columns = '';

        foreach ($keys as $key) {
           $columns .= ' ' . $key . ' = ?,';
        }
        $columns = trim($columns, ',');
        //$columns = implode(' = ?,', $keys);

        $tableName = $this->getTableName();
        $pdo = PdoConnect::getInstance();

        $sql = 'UPDATE ' . $tableName . ' SET ' . $columns . ' WHERE id = ' . $idArticle;
        $stmt = $pdo->prepare($sql);
        //$newArticle = array_values($newArticle);
        $stmt->execute($values);
        //$newComment = array_values($newComment);
        //$stmt->execute($newComment);

        return $this;

    }
}
