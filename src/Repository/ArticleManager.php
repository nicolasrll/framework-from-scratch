<?php

namespace App\Repository;

use Core\PdoConnect;
use Core\AbstractManager;
use App\Entity\Article;

class ArticleManager extends AbstractManager
{
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
