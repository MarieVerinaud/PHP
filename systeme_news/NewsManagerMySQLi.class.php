<?php

class NewsManagerMySQLi extends NewsManager
{
    public function __construct()
    {
        return mysqli_connect('localhost', 'root', '', 'cours_php');
    }
}