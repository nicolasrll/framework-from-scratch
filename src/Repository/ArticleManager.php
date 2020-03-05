<?php

namespace App\Repository;

use Core\PdoConnect;
use App\Entity\Article;

class ArticleManager extends AbstractManager
{
    const TABLE_NAME = 'Article';

    public function getTableName()
    {
        return self::TABLE_NAME;
    }

}
