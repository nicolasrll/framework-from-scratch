<?php

namespace Core;

use Core\PdoConnect;
use App\Entity\Article;
use App\Entity\Comment;

abstract class AbstractManager
{
    abstract public function getTableName();

    public function getConnectionPdo() {
        return PdoConnect::getInstance();
    }

    public function findOne($id)
    {
        //$pdo = PdoConnect::getInstance();
        $pdo = $this->getConnectionPdo();
        $entityName = $this->getTableName();

        //$stmt = $pdo->prepare('SELECT * FROM ' . $tableName . ' WHERE id = ?');
        $stmt = $pdo->prepare('SELECT * FROM ' . $entityName . ' WHERE ' . $this->getTablePk() . ' = ?');
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'App\Entity\\'. ucfirst($entityName));
        $stmt->execute([ $id ]);
        return $stmt->fetch();
    }

    // Ex function findAll()
    public function find(array $args = [])
    {
        // On récupère l'instance pdo
        // On récupère le nom de la table appelante
        // Si $arg est empty alors code de FindAll
        // Sinon search
        //$pdo = PdoConnect::getInstance();
        $pdo = $this->getConnectionPdo();
        $tableName = $this->getTableName();

        $requestSql = 'SELECT * FROM ' . $tableName;

        // if not empty then search function
        if (!empty($args)) {
            // Retrieve keys and values passed
            $keys = \array_keys($args);
            $values = array_values($args);

            $requestSql .= ' WHERE 1=1 ';
            foreach ($keys as $key) {
                $requestSql .= ' AND ' . $key . ' = ?';
            }
         }

        $stmt = $pdo->prepare($requestSql);

        // Execute function search with values passed
        if (isset($values)) {
            $stmt->execute($values);
            return $stmt->fetchAll();
        }

        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Polymorophisme utilisé pour appelé findOne, search ou findALl
    /*
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
        return $this->findAll($filter);
    }
    */
    public function insert(AbstractEntity $entity): bool
    {

        $properties = $entity->convertToArray();
        $columns = array_keys($properties);
        $columns = implode(',', $columns);
        $values = array_values($properties);
        $markers = array_fill(1, count($properties), '?');
        $markers = implode(',', $markers);

        $tableName = $this->getTableName();
        //$pdo = PdoConnect::getInstance();
        $pdo = $this->getConnectionPdo();
        $sql = 'INSERT INTO ' . $this->getTableName() . '('.$columns . ') VALUES (' . $markers . ')';
        $stmt = $pdo->prepare($sql);

        return $stmt->execute($values);
    }

    public function edit(AbstractEntity $entity): bool
    {
        // Used before using the id in the url in the WHERE
        $id = $entity->getId();

        echo '<br>';

        $properties = $entity->convertToArray();
        $keys = array_keys($properties);
        $values = array_values($properties);
        $columns = '';
        foreach ($keys as $key) {
           $columns .= ' ' . $key . ' = ?,';
        }
        $columns = trim($columns, ',');
        //$columns = implode(' = ?,', $keys);

        //$tableName = $this->getTableName();
        //$pdo = PdoConnect::getInstance();
        $pdo = $this->getConnectionPdo();
        //$sql = 'UPDATE ' . $tableName . ' SET ' . $columns . ' WHERE id = ' . $id;
        $sql = 'UPDATE ' . $this->getTableName() . ' SET ' . $columns . ' WHERE ' . $this->getTablePk() . ' = ' . $id;
        $stmt = $pdo->prepare($sql);

        return $stmt->execute($values);
    }

    public function delete(int $id): bool
    {
        //$tableName = $this->getTableName();
        //$pdo = PdoConnect::getInstance();
        $pdo = $this->getConnectionPdo();
        //$stmt = $pdo->prepare('DELETE FROM ' . $tableName .' WHERE id = ?');
        $stmt = $pdo->prepare('DELETE FROM ' . $this->getTableName() .' WHERE ' . $this->getTablePk() . '= ?');

        return $stmt->execute([$id]);
    }
}
