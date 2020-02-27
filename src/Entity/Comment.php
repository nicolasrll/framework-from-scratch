<?php
namespace App\Entity;

class CommentController
{
    private $id = 0;
    private $id_article = 0;
    private $author = '';
    private $date = '';
    private $content = '';

    public function __construct($article)
    {
        $this->title = $title;
        $this->name_author = $name_author;
        $this->date_update = $date_update;
        $this->chapo = $chapo;
        $this->content = $content;
        $this->url_project = $url_project;
    }


}
