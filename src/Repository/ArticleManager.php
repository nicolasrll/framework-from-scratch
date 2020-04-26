<?php

namespace App\Repository;

use Core\PdoConnect;
use Core\AbstractManager;
use App\Entity\Article;
//use Core\Traits\Repository\CudRepository;


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
