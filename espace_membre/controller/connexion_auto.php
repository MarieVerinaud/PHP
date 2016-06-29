<?php

include_once (__DIR__ . '/../model/BDD.class.php');

if (isset($_COOKIES['pseudo']) AND isset($_COOKIES['motDePasse']))
{
	$pseudo = htmlspecialchars($_COOKIES['pseudo']);
	$motDePasse = htmlspecialchars($_COOKIES['motDePasse']);

	$bdd = (new BDD())->getConnexion();
	$req = $bdd->prepare('SELECT id FROM membres WHERE pseudo = :pseudo AND pass = :pass');
	$req->execute(array(
	    'pseudo' => $pseudo,
	    'pass' => $motDePasse));

	$resultat = $req->fetch();
	$req->closeCursor();

	if (!$resultat)
	{
	    unset($_COOKIE['pseudo']);
	    unset($_COOKIE['motDePasse']);
    	setcookie('pseudo', '', time() - 3600, '/'); // empty value and old timestamp
    	setcookie('motDePasse', '', time() - 3600, '/'); // empty value and old timestamp
	}
	else
	{
		session_start();
    	$_SESSION['id'] = $resultat['id'];
    	$_SESSION['pseudo'] = $pseudo;
    	$_SESSION['message'] = 'Vous êtes connecté !';
	}
}