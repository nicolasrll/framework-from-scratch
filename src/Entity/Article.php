<?php

namespace App\Entity;

use Core\AbstractEntity;

class Article extends AbstractEntity
{
    protected $id;
    protected $title = '';
    protected $content = '';

    // Constructeur temporaire le temps de résouldre mon pb de fetch dans AbstractManager edit setFetchMode
    /*
    public function __construct($data)
    {
        $this->id = $data['id'] ?? null;
        $this->title = $data['title'];
        $this->content = $data['content'];
    }
    */

    /*
    public function hydrate(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->title = $data['title'] ?? '';
        $this->content = $data['content'] ?? '';

        return $this;
    }
    */

    /**
     * @return mixed
     */
    /*
    public function getId()
    {
        return $this->id ?? null;
    }
    */

    /**
     * @param mixed $id
     *
     * @return self
     */
    /*
    public function setId($id)
    {
        $this->id = $id ?? null;
    }
    */

    /**
     * @return mixed
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     *
     * @return self
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     *
     * @return self
     */
    public function setContent(string $content)
    {
        $this->content = $content;
    }
}
