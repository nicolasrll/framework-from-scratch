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

        //SANS LE BIND
        for ($i = 0; $i < count($args); $i++) {
            $requestSql .= ' AND ' . $keys[$i] . ' = ' . $args[$keys[$i]];
        }

       /*
       for ($i = 0; $i < count($args); $i++) {
            $requestSql .= ' AND ' . $keys[$i] . ' = :' . $keys[$i];
       }
       */
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

    function find($filter = null)
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

    public function add($data) {

        //$data = $entity->convertToArray();

        if (isset($data['id'])) {
            unset($data['id']);
        }

        // Je récupère les clés des propriétés
        $keys = array_keys($data);
        $columns = implode(',', $keys);

        // Je créer mes chaines vide qui vont me servir dans le requete préparer
        $colmunsValues = '';
        // Je boucle dessus
        foreach ($keys as $key) {
           $colmunsValues .= ' ' . ':' . $key . ',';
        }
        // Je supprime les virgules de fin de chaine
        $colmunsValues = trim($colmunsValues, ',');

        // Je récupère mon instance PDO
        $pdo = PdoConnect::getInstance();
        // Je récupère le nom de la table appelante
        $tableName = $this->getTableName();
        // Je prépare ma requête
        $sql = 'INSERT INTO ' . $tableName . '(' . $columns . ') VALUES (' . $colmunsValues . ')';
        $stmt = $pdo->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        // J'exécute
       $stmt->execute();

       return true;
    }

    public function update($data){
        // UPDATE article SET name_field1 = 'new value', name_field2 = 'new value' WHERE id = $entity->getId
        // On boucle pour parcourir l'ensemble des champs d'un commentaire ou d'un article et lui attribuer sa nouvelle valeur (name_field1 = 'new value', ...)
        // On stocke ça dans une variable
        // On construit la requête en venant concaténé la variable précédente

        //$data = $entity->convertToArray();
        $keys = array_keys($data);

        $columns = '';
        // Je boucle dessus
        foreach ($keys as $key) {
           $columns .= ' ' . $key . ' = :' . $key . ',';
        }
        $columns = trim($columns, ',');

        $pdo = PdoConnect::getInstance();
        $tableName = $this->getTableName();
        $sql = 'UPDATE ' . $tableName . ' SET ' . $columns . ' WHERE id = ' . $data['id'];
        $stmt = $pdo->prepare($sql);
        $newArticle = [
            'id' => 25,
            'title' => 'Une table mise à jour ',
            'content' => 'mon nouveau contenu'
        ];
        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $newArticle[$key] );
        }

        $stmt->execute();

        return true;
    }

    //public function save($idArticle = null)
    public function save($entity)
    {
        $data = $entity->convertToArray();

        // Tester le polymorphisme une fois que j'aurais régler mon histoire de id (comment le gérer ?)
        if (!is_null($data['id']) && is_int($data['id'])) {
            return $this->update($data);
        }

        return $this->add($data);

    }
}
