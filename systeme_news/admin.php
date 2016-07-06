<?php
function chargerClasse($classname)
{
    require $classname.'.class.php';
}

spl_autoload_register('chargerClasse');

$manager = new NewsManagerPDO;

if(isset($_GET['modifier']) AND ($_GET['modifier']>0))
{
    $id = (int) $_GET['modifier'];
    $newAModifier = $manager->getOneNews($id);
}

if(isset($_GET['supprimer']) AND ($_GET['supprimer']>0))
{
    $id = (int) $_GET['supprimer'];
    $manager->deleteNews($_GET['supprimer']);
}

if(isset($_POST['auteur']) AND isset($_POST['titre']) AND isset($_POST['contenu']))
{
    $auteur = htmlspecialchars($_POST['auteur']);
    $titre = htmlspecialchars($_POST['titre']);
    $contenu = htmlspecialchars($_POST['contenu']);
    $news = new News();
    $news->setAuteur($auteur);
    $news->setTitre($titre);
    $news->setContenu($contenu);

    if (isset($_POST['id']) AND $news->isValid())
    {
        $id = (int) $_POST['id'];
        $news->setId($id);
        $manager->updateNews($news);
    }
    else if ($news->isValid())
    {
        $manager->addNews($news);
    }
}
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
            Auteur : <input type="text" name="auteur" value="<?php if(isset($_GET['modifier'])) echo $newAModifier['auteur']; ?>" /><br />

            Titre : <input type="text" name="titre" value="<?php if(isset($_GET['modifier'])) echo $newAModifier['titre']; ?>" /><br />

            Contenu :<br /><textarea rows="8" cols="60" name="contenu"><?php if(isset($_GET['modifier'])) echo $newAModifier['contenu']; ?></textarea><br />
            <input type="hidden" name="id" value="<?php if(isset($_GET['modifier'])) echo $newAModifier['id'];?>" />
            <input type="submit" value="<?php if(isset($_GET['modifier'])) echo 'Modifier'; else echo 'Ajouter';?>" />
        </p>
    </form>

    <p style="text-align: center">Il y a actuellement <?php echo $manager->countNews(); ?> news. En voici la liste :</p>

    <table>
        <tr><th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
        <?php
        foreach ($manager->getNews() as $news)
        {
        ?>
        <tr><td><?php echo $news->auteur(); ?></td><td><?php echo $news->titre(); ?></td><td><?php echo $news->dateAjout(); ?></td><td><?php echo $news->dateModif(); ?></td><td><a href="?modifier=<?php echo $news->id(); ?>">Modifier</a> | <a href="?supprimer=<?php echo $news->id(); ?>" onclick="return confirm('Etes-vous sûr ?')">Supprimer</a></td>
        <?php
        }
        ?>
    </table>
    </body>
</html>