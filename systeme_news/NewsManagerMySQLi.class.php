<?php

class NewsManagerMySQLi extends NewsManager
{
    private $db;

    public function __construct()
    {
        try
        {
            $this->db = mysqli_connect('localhost', 'root', '', 'cours_php');
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
        $q = mysqli_query($this->db, 'SELECT id, titre, auteur, contenu, DATE_FORMAT(dateAjout, \'%d/%m/%Y à %H:%i\') AS dateAjout, DATE_FORMAT(dateModif, \'%d/%m/%Y à %H:%i\') AS dateModif FROM news LIMIT 0,5');

        $news = $q->mysqli_fetch_assoc();
        mysqli_free_result($q);
        return $news;
    }

    public function countNews()
    {
        $req = mysqli_query($this->db, 'SELECT * FROM news');
        return mysqli_num_rows($req);
    }

    public function deleteNews($id)
    {
        mysqli_query($this->db, 'DELETE FROM news WHERE id=' .$id);
    }

    public function addNews(News $news)
    {
        $date_ajout = date("Y-m-d H:i:s");

        $q = mysqli_prepare($this->db, 'INSERT INTO news(titre, auteur, contenu, dateAjout) VALUES(?, ?, ?, ?)');
        mysqli_stmt_bind_param($q, "ssss", $news->titre(),$news->auteur(),$news->contenu(),$date_ajout);

        mysqli_stmt_execute($q);

        $news->hydrate([
            'id' => $this->db->lastInsertId()
        ]);
    }

    public function updateNews(News $news)
    {
        $q = mysqli_prepare($this->db, '
        UPDATE news
        SET titre = :titre
        , auteur = :auteur
        , contenu = :contenu
        , dateModif = NOW()
        WHERE id = :id');
        mysqli_stmt_bind_param($q, "sssi", $news->titre(), $news->auteur(), $news->contenu(), $news->id());

        mysqli_stmt_execute($q);
    }

    public function getOneNews($id)
    {
        $q = mysqli_query($this->db, 'SELECT id, titre, auteur, contenu, DATE_FORMAT(dateAjout, \'%d/%m/%Y à %H:%i\') AS dateAjout, DATE_FORMAT(dateModif, \'%d/%m/%Y à %H:%i\') AS dateModif FROM news WHERE id='.$id);
        $news = $q->mysqli_fetch_object('News');
        mysqli_free_result($q);
        return $news;
    }
}