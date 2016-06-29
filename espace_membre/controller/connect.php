<?php
include_once (__DIR__ . '/../model/BDD.class.php');
// Hachage du mot de passe
$pseudo = htmlspecialchars($_POST['pseudo']);
$motDePasse = htmlspecialchars($_POST['motDePasse']);

$pass_hache = sha1($_POST['motDePasse']);

// Vérification des identifiants
$bdd = (new BDD())->getConnexion();
$req = $bdd->prepare('SELECT id FROM membres WHERE pseudo = :pseudo AND pass = :pass');
$req->execute(array(
    'pseudo' => $pseudo,
    'pass' => $pass_hache));

$resultat = $req->fetch();
$req->closeCursor();

if (!$resultat)
{
    echo 'Mauvais identifiant ou mot de passe !';
}
else
{
    session_start();
    $_SESSION['id'] = $resultat['id'];
    $_SESSION['pseudo'] = $pseudo;
    $_SESSION['message'] = 'Vous êtes connecté !';
    if(isset($_POST['connexion_auto']))
    {
    	setcookie('pseudo', '$pseudo', time() + 365*24*3600, null, null, false, true);
    	setcookie('motDePasse', '$pass_hache', time() + 365*24*3600, null, null, false, true);
    }    
    header('Location:../view/home.php');
}