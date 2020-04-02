<?php

namespace App\Entity;

use Core\AbstractEntity;

class Comment extends AbstractEntity
{
    protected $id;
    protected $articleId;
    protected $pseudo = '';
    protected $comment = '';

    /*
    public function __construct($data)
    {
        $this->id = $data['id'] ?? null;
        $this->article_id = $data['article_id'] ?? null;
        $this->pseudo = $data['pseudo'];
        $this->comment = $data['comment'];
    }
    */

/*
    public function hydrate(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->article_id = $data['article_id'] ?? null;
        $this->pseudo = $data['pseudo'];
        $this->comment = $data['comment'];

        return $this; //  use for fluent pattern
    }
*/

    /**
     * @return mixed
     */
    public function getArticleId()
    {
        return $this->articleId;
    }

    /**
     * @param mixed $article_id
     *
     * @return self
     */
    public function setArticleId($articleId)
    {
        $this->articleId = $articleId ?? null;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param mixed $pseudo
     *
     * @return self
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     *
     * @return self
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }
}
