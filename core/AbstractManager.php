<?php

namespace Core;

use Core\PdoConnect;
use Pdo;
use Core\Traits\CudRepository;
use Core\Traits\SearchRepository;

abstract class AbstractManager
{
     use CudRepository;
     use SearchRepository;

    abstract public function getTableName();
    abstract public function getTablePk();

    public function getPdo(): Pdo
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
