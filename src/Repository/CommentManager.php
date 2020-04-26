<?php

namespace App\Repository;

use Core\AbstractManager;

class CommentManager extends AbstractManager
{
    const TABLE_NAME = 'comment';
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
