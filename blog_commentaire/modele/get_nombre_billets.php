<?php
function get_nombre_billets()
{
    global $bdd;

    $req = $bdd->query("SELECT COUNT(*) AS nbBillet FROM billets");
    $nbBillets = $req->fetchAll();
    
    return $nbBillets;
}