<?php

namespace App\Entity;

class Article
{
    private $id;
    public $title = '';
    private $content = '';

    public function hydrate(array $data)
    {
	    $this->id = $data['id'] ?? null;
	    $this->title = $data['title'] ?? '';
	    $this->content = $data['content'] ?? '';

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
