<?php

namespace App\Entity;

class Article
{
    private $id = 0;
    private $title = '';
    private $content = '';
    private $date_created;

    public function __construct($data)
    {
        $this->title = $data['title'];
        $this->content = $data['content'];
        $this->date_created = $data['date_created'];
        //$this->getArticle();

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

    /**
     * @return mixed
     */
    public function getDateCreated()
    {
        return $this->date_created;
    }

    /**
     * @param mixed $date_created
     *
     * @return self
     */
    public function setDateCreated($date_created)
    {
        $this->date_created = $date_created;
    }

    /*
    public function getArticle()
    {
        ?>
        <h3><?php echo $this->title; ?></h3>
        <p><?php echo $this->date_created; ?></p>
        <p><?php echo $this->content; ?></p>
    }
    */
}
