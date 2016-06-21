<?php

if (isset($_POST['pseudo']) AND isset($_POST['message']))
{
	$pseudo = htmlspecialchars($_POST['pseudo']);
	$message = htmlspecialchars($_POST['message']);
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=cours_php', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
	
	$requete_ajout = $bdd->prepare('INSERT INTO mini_chat(pseudo, message) VALUES (:pseudo, :message)');
	$requete_ajout->execute(array(
		'pseudo' => $pseudo,
		'message' => $message
		));
}

header('Location: minichat.php');

?>