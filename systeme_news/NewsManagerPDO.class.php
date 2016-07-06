<?php

class NewsManagerPDO extends NewsManager
{
    private $db;

    public function __construct()
    {
        try
        {
            $this->db = new PDO('mysql:host=localhost;dbname=cours_php;charset=utf8', 'root', '');
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    public function getConnexion()
    {
        return $this->db;
    }

    public function getNews()
    {
        $q = $this->db->query('SELECT * FROM news LIMIT 0,5');

        $q->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'News');

        $news = $q->fetchAll();
        $q->closeCursor();
        return $news;
    }

    public function countNews()
    {
        return $this->db->query('SELECT COUNT(*) FROM news')->fetchColumn();
    }

    public function deleteNews(News $news)
    {
        $this->db->exec('DELETE FROM news WHERE id= '.$news->id());
    }

    public function addNews(News $news)
    {
        $q = $this->db->prepare('INSERT INTO news(titre, auteur, contenu, dateAjout) VALUES(:titre, :auteur, :contenu, :dateAjout)');
        $q->bindValue(':titre', $news->titre());
        $q->bindValue(':auteur', $news->auteur());
        $q->bindValue(':contenu', $news->contenu());
        $q->bindValue(':dateAjout', $news->dateAjout());

        $q->execute();
        $q->closeCursor();

        $news->hydrate([
            'id' => $this->db->lastInsertId()
        ]);
    }

    public function updateNews(News $news)
    {
        $q = $this->db->prepare('
        UPDATE news
        SET titre = :titre
        , auteur = :auteur
        , contenu = :contenu
        , dateModif = :dateModif
        WHERE id = :id');
        $q->bindValue(':titre', $news->titre());
        $q->bindValue(':auteur', $news->auteur());
        $q->bindValue(':contenu', $news->contenu());
        $q->bindValue(':dateModif', $news->dateModif());
        $q->bindValue(':id', $news->id());

        $q->execute();
        $q->closeCursor();
    }

    public function getOneNews($id)
    {
        $q = $this->db->query('SELECT * FROM news WHERE id='.$id);
        $news = $q->fetch(PDO::FETCH_ASSOC);
        $q->closeCursor();
        return $news;
    }
}