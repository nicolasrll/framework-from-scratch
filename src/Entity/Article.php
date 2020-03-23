<?php

namespace App\Entity;

use Core\AbstractEntity;

class Article extends AbstractEntity
{
    protected $id;
    protected $title = '';
    protected $content = '';

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

    public function convertToArray()
    {
        //if (isset($this->id)) {
            unset($this->id);
        //}

        return get_object_vars($this);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id ?? null;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id ?? null;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     *
     * @return self
     */
    public function setContent($content)
    {
        $this->content = $content;
    }
}
