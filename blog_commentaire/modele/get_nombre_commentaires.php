<?php
function get_nombre_commentaires($id_commentaire)
{
    global $bdd;
    $id_commentaire = (int) $id_commentaire;

    $req = $bdd->prepare("SELECT COUNT(*) AS nbCommentaires FROM commentaires WHERE id_billet = :id_commentaire");
    $req->execute(array(
    'id_commentaire' => $id_commentaire
	));
    $nbCommentaires = $req->fetchAll();
    
    return $nbCommentaires;
}