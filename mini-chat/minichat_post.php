<?php

if (isset($_POST['pseudo']) AND isset($_POST['message']))
{
	date_default_timezone_set('Europe/Paris');
	$pseudo = htmlspecialchars($_POST['pseudo']);
	$message = htmlspecialchars($_POST['message']);
	$date_message = date("Y-m-d H:i:s");
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=cours_php', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
	
	$requete_ajout = $bdd->prepare('INSERT INTO mini_chat(pseudo, message, date_message) VALUES (:pseudo, :message, :date_message)');
	$requete_ajout->execute(array(
		'pseudo' => $pseudo,
		'message' => $message,
		'date_message' => $date_message
		));
}

header('Location: minichat.php?pseudo=' . $pseudo . '&p=1');

?>