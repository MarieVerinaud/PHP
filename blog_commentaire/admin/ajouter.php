<?php

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=cours_php;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
	die('Erreur : '.$e->getMessage());
}
?>
<h2><a href="admin.php">Retour à la liste des billets</a></h2>

<form method="post">
<p>
	<label>Titre : <input type="text" name="titre"/></label>
</p>
<p>
	<label>Contenu : <input type="text" name="contenu"/></label>
</p>
<p>
	<input type="submit" value="Ajouter"/>
</p>
</form>

<?php
if (isset($_POST['titre']) AND isset($_POST['contenu']))
{
	date_default_timezone_set('Europe/Paris');
	$titre = htmlspecialchars($_POST['titre']);
	$contenu = htmlspecialchars($_POST['contenu']);
	$date_creation = date("Y-m-d H:i:s");
	
	$requete_nb->closeCursor();
	
	$requete_ajout = $bdd->prepare('INSERT INTO billets(titre, contenu, date_creation) VALUES (:titre, :contenu, :date_creation)');
	$requete_ajout->execute(array(
		'titre' => $titre,
		'contenu' => $contenu,
		'date_creation' => $date_creation
		));

	echo 'Votre billet a bien été ajouté !';
	$requete_ajout-> closeCursor();

	header('Location: admin.php');
}
?>