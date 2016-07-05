<?php

class NewsManagerPDO extends NewsManager
{
    public function __construct()
    {
        return new PDO('mysql:host=localhost;dbname=cours_php', 'root', '');
    }
}