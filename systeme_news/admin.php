<?php
function chargerClasse($classname)
{
    require $classname.'.class.php';
}

spl_autoload_register('chargerClasse');

$manager = new NewsManagerPDO;
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Administration</title>
        <meta charset="utf-8" />

        <style type="text/css">
            table, td {
                border: 1px solid black;
            }

            table {
                margin:auto;
                text-align: center;
                border-collapse: collapse;
            }

            td {
                padding: 3px;
            }
        </style>
    </head>

    <body>
    <p><a href=".">Accéder à l'accueil du site</a></p>

    <form action="admin.php" method="post">
        <p style="text-align: center">
            Auteur : <input type="text" name="auteur" value="" /><br />

            Titre : <input type="text" name="titre" value="" /><br />

            Contenu :<br /><textarea rows="8" cols="60" name="contenu"></textarea><br />
            <input type="submit" value="Ajouter" />
        </p>
    </form>

    <p style="text-align: center">Il y a actuellement <?php echo $manager->countNews(); ?> news. En voici la liste :</p>

    <table>
        <tr><th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
    </table>
    </body>
</html>