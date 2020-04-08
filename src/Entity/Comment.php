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
    public function getArticleId(): int
    {
        return $this->articleId;
    }

    /**
     * @param mixed $article_id
     *
     * @return self
     */
    public function setArticleId(int $articleId)
    {
        $this->articleId = $articleId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    /**
     * @param mixed $pseudo
     *
     * @return self
     */
    public function setPseudo(string $pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     *
     * @return self
     */
    public function setComment(string $comment)
    {
        $this->comment = $comment;

        return $this;
    }
}
