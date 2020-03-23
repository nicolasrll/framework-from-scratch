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
        $data = $request->fetch(\PDO::FETCH_ASSOC);

        return $data;
    }


    public function findAll()
    {
        $pdo = PdoConnect::getInstance();
        $articles = [];

        $tableName = $this->getTableName();
        $request = $pdo->query('SELECT * FROM ' . $tableName);
        while ($data = $request->fetch(\PDO::FETCH_ASSOC)) {
            $result[] = $data;
        }

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

    public function add($entity) {
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

    public function update($entity) {
        $id = $entity->getId();
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
        $newArticle = [
            //'id' => 57,
            'title' => 'Chalet & foie gras',
            'content' => 'Ici se trouve le contexte du projet 2 du parcours',
        ];
        $newComment = [
            'article_id' => 4,
            'pseudo' => 'LaTour',
            'comment' => 'design au top'
        ];
        $sql = 'UPDATE ' . $tableName . ' SET ' . $columns . ' WHERE id = ' . $id;
        $stmt = $pdo->prepare($sql);
        $newArticle = array_values($newArticle);
        $stmt->execute($newArticle);
        //$newComment = array_values($newComment);
        //$stmt->execute($newComment);
    }
}
