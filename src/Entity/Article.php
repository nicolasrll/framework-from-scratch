<?php
namespace App\Entity;

use Core\{DefaultController, Request};

class ArticleController extends DefaultController
{
    private $id = 0;
    private $title = '';
    private $name_author = '';
    private $date_update = '';
    private $chapo = '';
    private $content = '';
    private $url_project = '';

    public function __construct($article)
    {
        $this->title = $title;
        $this->name_author = $name_author;
        $this->date_update = $date_update;
        $this->chapo = $chapo;
        $this->content = $content;
        $this->url_project = $url_project;
    }

    /**
     * @return mixed
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

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

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNameAuthor(): string
    {
        return $this->name_author;
    }

    /**
     * @param mixed $name_author
     *
     * @return self
     */
    public function setNameAuthor(string $name_author)
    {
        $this->name_author = $name_author;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateUpdate()
    {
        return $this->date_update;
    }

    /**
     * @param mixed $date_update
     *
     * @return self
     */
    public function setDateUpdate($date_update)
    {
        $this->date_update = $date_update;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getChapo(): string
    {
        return $this->chapo;
    }

    /**
     * @param mixed $chapo
     *
     * @return self
     */
    public function setChapo(string $chapo)
    {
        $this->chapo = $chapo;

        return $this;
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

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrlProject(): string
    {
        return $this->url_project;
    }

    /**
     * @param mixed $url_project
     *
     * @return self
     */
    public function setUrlProject(string $url_project)
    {
        $this->url_project = $url_project;

        return $this;
    }
