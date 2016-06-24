<?php

include_once('../modele/connexion_sql.php');

?>

<?php

$requete_nb = $bdd->query("SELECT COUNT(*) AS nbBillet FROM billets");
$data = $requete_nb->fetch();
$nbBillet = $data['nbBillet'];
                

if (isset($_GET['ID']) AND $_GET['ID']>0 AND $_GET['ID'] <= $nbBillet)
{
	$requete_nb->closeCursor();
	
	$requete_suppr = $bdd->query('DELETE FROM billets WHERE id = $_GET[\'ID\']');
	
	echo 'Le billet a bien été supprimé !';
	$requete_suppr -> closeCursor();

}

header('Location: admin.php');
?>