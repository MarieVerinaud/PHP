<?php


include_once('Membre.class.php');
include_once('inscription_post.php');

$pseudo = htmlspecialchars($_POST("pseudo"));
$eMail = htmlspecialchars($_POST("eMail"));
$motDePasse = htmlspecialchars($_POST("motDePasse"));
$confirmationMotDePasse = htmlspecialchars($_POST("confirmationMotDePasse"));


$membre = new Membre();

$reponse = $bdd->query('SELECT pseudo FROM membres WHERE pseudo = "' . $pseudo . '" ');
$login = $reponse->fetch();

if (strtolower($pseudo == strtolower($login['pseudo']))
{
    echo "Ce pseudo est déjà utilisé.";
}
else
{
    $membre->setPseudo($pseudo);
}


if (!$membre->setEmail($eMail)
{
    echo "L'email n'est pas valide.";
}

if(!$membre->setMotDePasse($motDePasse) AND $motDePasse!= $confirmationMotDePasse)
{
    echo "Le mot de passe n'est pas valide.";
}

?>