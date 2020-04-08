<?php

namespace Core;

use Core\PdoConnect;
//use App\Entity\Article;
//use App\Entity\Comment;
use Core\Traits\CudRepository;
use Core\Traits\Search;


abstract class AbstractManager
{
     use CudRepository;
     use Search;

    abstract public function getTableName();

    public function getPdo(): \PDO
    {
        return PdoConnect::getInstance();
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

}
