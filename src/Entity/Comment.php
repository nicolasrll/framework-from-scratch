<?php

namespace App\Entity;

class Comment
{
    private $id = 0;
    private $article_id = 0;
    private $pseudo = '';
    private $comment = '';

    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->article_id = $data['article_id'];
        $this->pseudo = $data['pseudo'];
        $this->comment = $data['comment'];
    }
}
