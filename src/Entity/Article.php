<?php

namespace App\Entity;

use Core\AbstractEntity;

class Article extends AbstractEntity
{
    protected $id;
    protected $title = '';
    protected $content = '';

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string
     */
    public function setContent(string $content)
    {
        $this->content = $content;
    }
}
