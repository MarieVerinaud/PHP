<?php
require_once ('NewsManagerPDO.class.php');
require_once ('NewsManagerMySQLi.class.php');

abstract class NewsManager
{
    public function getNews()
    {
        $db = new NewsManagerPDO;
        $q = $db->query('SELECT * FROM news LIMIT 0,5');

        $q->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'News');

        $news = $q->fetchAll();
        return $news;
    }

}



