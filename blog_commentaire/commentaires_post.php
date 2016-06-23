<?php

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=cours_php;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
	die('Erreur : '.$e->getMessage());
}

$requete_nb = $bdd->query("SELECT COUNT(*) AS nbBillet FROM billets");
$data = $requete_nb->fetch();
$nbBillet = $data['nbBillet'];
                

if (isset($_POST['pseudo']) AND isset($_POST['commentaire']) AND isset($_GET['ID']) AND $_GET['ID']>0 AND $_GET['ID'] <= $nbBillet)
{
	date_default_timezone_set('Europe/Paris');
	$pseudo = htmlspecialchars($_POST['pseudo']);
	$commentaire = htmlspecialchars($_POST['commentaire']);
	$date_commentaire = date("Y-m-d H:i:s");
	
	$requete_nb->closeCursor();
	
	$requete_ajout = $bdd->prepare('INSERT INTO commentaires(id_billet, auteur, commentaire, date_commentaire) VALUES (:id_billet, :auteur, :commentaire, :date_commentaire)');
	$requete_ajout->execute(array(
		'id_billet' => $_GET['ID'],
		'auteur' => $pseudo,
		'commentaire' => $commentaire,
		'date_commentaire' => $date_commentaire
		));

	echo 'Votre commentaire a bien été ajouté !';
}

header('Location: commentaires.php?ID='. $_GET['ID']);

?>