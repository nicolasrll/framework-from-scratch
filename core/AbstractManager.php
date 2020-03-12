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

    //public function add(Article $article)
    // ancienne fonction save non dynamique
    public function add(array $args = [])
    {
        // Preparation de la requete
        // Initialisation des variables avec les valeurs
        // Exécution de la requête
        echo '<br><br>';

        // Je check ce que je récupère en paramètre
        // Je récupère la connexion à la bdd
        $pdo = PdoConnect::getInstance();
        // On récupère le nom de la table
        $tableName = $this->getTableName();
        echo '<br>';

        // Préparation de la requete
        $request = $pdo->prepare('INSERT INTO ' . $tableName . ' (title, content) VALUES (:title, :content)');

        //$request->bindValue(':title', $args['title']);
        //$request->bindValue(':content', $args['content']);
        //$request->bindValue(':content', 'Ce travail de création a été réalisé depuis la page index');
        //$request->bindValue(':pseudo', $args['pseudo']);
        //$request->bindValue(':comment', $args['comment']);
        //$request->execute();

    }

    public function save($entity) {
       // Je récupère les clés des propriétés
       $keys = array_keys($entity);
       // Je créer mes chaines vide qui vont me servir dans le requete préparer
       $string1 = '';
       $string2 = '';
       // Je boucle dessus
       foreach ($keys as $key) {
           $string1 .= ' ' . $key . ',';
           $string2 .= ' ' . ':' . $key . ',';
       }
       // Je supprime les virgules de fin de chaine
       $string1 = trim($string1, ',');
       echo '<br>';
       echo '<br>' . $string1;
       $string2 = trim($string2, ',');
       // Je récupère mon instance PDO
       $pdo = PdoConnect::getInstance();
       // Je récupère le nom de la table appelante
       $tableName = $this->getTableName();
       // Je prépare ma requête
        $request = $pdo->prepare('INSERT INTO ' . $tableName . '(' . $string1 . ') VALUES (' . $string2 . ')');

       //foreach ($items as $kitem) {
       for ($i = 0; $i < count($items); $i++) {
            $request->bindValue($params[$i], $items[$i]);
        }
       $request->execute();

    }

}
