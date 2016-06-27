<?php


include_once('Membre.class.php');
include_once('inscription_post.php');


$membre = new Membre();

$reponse = $bdd->query('SELECT login FROM membre WHERE login = "' . $_POST['login'] . '" ');
$login = $reponse->fetch();
 
$reponse = $bdd->query('SELECT mail FROM membre WHERE mail = "' . $_POST['mail'] . '" ');
$mail = $reponse->fetch();
if (strtolower($_POST['pseudo']) == strtolower($login['pseudo']))
{
    $erreur = "Ce pseudo est déjà utilisé.";
}
else
{
    $membre->setPseudo($_POST("pseudo");
}


if(!$membre->setEmail($_POST("eMail")))
{
    echo "L'email n'est pas valide.";
}

if(!$membre->setMotDePasse($_POST("motDePasse") AND $_POST("motDePasse")!= $_POST("confirmationMotDePasse"))
{
    echo "Le mot de passe n'est pas valide.";
}





?>