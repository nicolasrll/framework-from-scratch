<?php

namespace App\Repository;

use Core\PdoConnect;
use Core\AbstractManager;
use App\Entity\Comment;

class CommentManager extends AbstractManager
{
    /**
     *  On veut pouvoir voir un ou tous les commentaire rattaché à un article. Pour ça on utilise findOne et findAll comme Article
     */
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
