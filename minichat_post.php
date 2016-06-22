<?php

if (isset($_POST['pseudo']) AND isset($_POST['message']))
{
	date_default_timezone_set('Europe/Paris');
	$pseudo = htmlspecialchars($_POST['pseudo']);
	$message = htmlspecialchars($_POST['message']);
	$heure = date("G:i:s");
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=cours_php', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
	
	$requete_ajout = $bdd->prepare('INSERT INTO mini_chat(pseudo, message, heure) VALUES (:pseudo, :message, :heure)');
	$requete_ajout->execute(array(
		'pseudo' => $pseudo,
		'message' => $message,
		'heure' => $heure
		));
}

header('Location: minichat.php?pseudo=' . $pseudo);

?>