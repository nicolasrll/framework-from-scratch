<?php

namespace App\Repository;

use Core\AbstractManager;

class ArticleManager extends AbstractManager
{

    //use CudRepository;

    const TABLE_NAME = 'article';
    const TABLE_PK = 'id';

    public function getTableName()
    {
        return self::TABLE_NAME;
    }

    public function getTablePk()
    {
        return self::TABLE_PK;
    }

}
