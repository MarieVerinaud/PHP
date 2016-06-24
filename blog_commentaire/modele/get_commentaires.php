<?php
function get_commentaires($id_commentaire, $offset, $limit)
{
    global $bdd;
    $offset = (int) $offset;
    $limit = (int) $limit;
    $id_commentaire = (int) $id_commentaire;
        
    $req = $bdd->prepare('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire 
        FROM commentaires WHERE id_billet = :id_commentaire LIMIT :offset, :limit');
    $req->bindParam(':offset', $offset, PDO::PARAM_INT);
    $req->bindParam(':limit', $limit, PDO::PARAM_INT);
    $req->bindParam(':id_commentaire', $id_commentaire, PDO::PARAM_INT);
    $req->execute();
    $commentaires = $req->fetchAll();
    return $commentaires;
}