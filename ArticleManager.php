<?php

class ArticleManager
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * @return mixed
     */
    // Pas utile mais créer juste pour le debug
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @param mixed $db
     *
     * @return self
     */
    public function setDb($db)
    {
        $this->db = $db;

        return $this;
    }

    // Liste des function :
    //  - add
    //  - update
    //  - read
    //  - delete

    public function findOne($id)
    {
        $request = $this->db->query('SELECT * FROM Article WHERE id = ' . $id);
        $data = $request->fetch(PDI::FETCH_ASSOC);

        return new Article($data);
    }

    public function findAll()
    {
        $articles = [];
        $request = $this->db->query('SELECT * FROM Article ORDER BY name');
        while ($data = $request->fetch(PDI::FETCH_ASSOC)) {
            $articles[] = new Article($data);
        }

        return $articles;
    }


    public function add(Article $article)
    {
        // Preparation de la requete
        // Initialisation des variables avec les valeurs
        // Exécution de la requête
        $request = $db->prepare('INSERT INTO Article(title, name_author, date_update, chapo, content) VALUES(:title, :name_author, :date_update, :chapo, :content)');
        $request->bindValue(':title', $article->getTitle());
        $request->bindValue(':name_author', $article->getNameAuthor());
        $request->bindValue(':date_update', $article->getDateUpdate());
        $request->bindValue(':chapo', $article->getChapo());
        $request->bindValue(':content', $article->getContent());


    }

    public function update(Article $article)
    {
        // Preparation de la requete
        // Initialisation des variables avec les valeurs
        // Exécution de la requête

    }

    public function delete(Article $article)
    {
        $this->db->exec('DELETE * FROM Article WHERE id = ' . $article->id());

    }
}
