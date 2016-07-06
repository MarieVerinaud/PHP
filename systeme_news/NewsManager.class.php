<?php
require_once ('NewsManagerPDO.class.php');
require_once ('NewsManagerMySQLi.class.php');

abstract class NewsManager
{
    public function getConnexion()
    {
    }

    public function getNews()
    {
    }

    public function countNews()
    {
    }
    
    public function deleteNews($id)
    {
    }

    public function addNews(News $news)
    {
    }
    
    public function updateNews(News $news)
    {
    }
    
    public function getOneNews()
    {
    }

}



