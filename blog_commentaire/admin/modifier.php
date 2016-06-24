<?php

include_once('../modele/connexion_sql.php');

?>
<h2><a href="admin.php">Retour à la liste des billets</a></h2>

<h2>Modification du billet :</h2>
<form method="post">
<p>
	<label>Nouveau titre <input type="text" name="titre"/></label>
</p>
<p>
	<label>Nouveau contenu <input type="text" name="contenu"/></label>
</p>
<p>
	<input type="submit" value="Mettre à jour"/>
</p>
</form>

<?php

$requete_nb = $bdd->query("SELECT COUNT(*) AS nbBillet FROM billets");
$data = $requete_nb->fetch();
$nbBillet = $data['nbBillet'];
                

if (isset($_POST['titre']) AND isset($_POST['contenu']) AND isset($_GET['ID']) AND $_GET['ID']>0 AND $_GET['ID'] <= $nbBillet)
{
	date_default_timezone_set('Europe/Paris');
	$titre = htmlspecialchars($_POST['titre']);
	$contenu = htmlspecialchars($_POST['contenu']);
	$date_creation = date("Y-m-d H:i:s");
	
	$requete_nb->closeCursor();
	
	$requete_modif = $bdd->prepare('UPDATE billets SET titre = :titre, contenu = :contenu, date_creation = :date_creation WHERE id = $_GET[\'ID\']');
	$requete_modif->execute(array(
		'titre' => $titre,
		'contenu' => $contenu,
		'date_creation' => $date_creation
		));

	echo 'Le billet a bien été modifié !';
	$requete_modif -> closeCursor();

	header('Location: admin.php');
}
?>