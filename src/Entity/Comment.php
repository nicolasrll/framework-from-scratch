<?php

namespace App\Entity;

class Comment
{
    private $id;
    private $article_id;
    private $pseudo = '';
    private $comment = '';

    /*
    public function __construct($data)
    {
        $this->id = $data['id'] ?? null;
        $this->article_id = $data['article_id'] ?? null;
        $this->pseudo = $data['pseudo'];
        $this->comment = $data['comment'];
    }
    */

    public function hydrate(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->article_id = $data['article_id'] ?? null;
        $this->pseudo = $data['pseudo'];
        $this->comment = $data['comment'];

        return $this;
    }

    public function convertToArray()
    {
        return get_object_vars($this);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getArticleId()
    {
        return $this->article_id;
    }

    /**
     * @param mixed $article_id
     *
     * @return self
     */
    public function setArticleId($article_id)
    {
        $this->article_id = $article_id;

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
