<?php

function chargerClasse($classname)
{
    require $classname.'.class.php';
}

spl_autoload_register('chargerClasse');
$manager = new NewsManagerPDO();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Accueil du site</title>
        <meta charset="utf-8" />
    </head>

    <body>
        <p><a href="admin.php">Accéder à l'espace d'administration</a></p>
        <?php
        if(isset($_GET['id']))
        {
            $new = $manager->getOneNews($_GET['id']);
            ?>
            <p><a href="index.php">Retour à la liste des news</a></p>
            <p>Par <em><?php echo $new['auteur'] ?></em>, le <?php echo $new['dateAjout']; ?></p>
            <h2><?php echo $new['titre']; ?></h2>
            <p><?php echo $new['contenu']; ?></p>
            <?php if ($new['dateModif'] !== NULL)
            {
                ?>
                <p style="text-align: right"><small><em>Modifiée le <?php echo $new['dateModif']; ?></em></small></p>
                <?php
            }
        }
        else
        {
            echo '<h2 style="text-align:center">Liste des 5 dernières news</h2>';
            foreach ($manager->getNews() as $news)
            {
                if (strlen($news->contenu()) <= 200)
                {
                    $contenu = $news->contenu();
                }
                else
                {
                    $debut = substr($news->contenu(), 0, 200);
                    $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
                    $contenu = $debut;
                }
                echo '<h4><a href="?id=', $news->id(), '">', $news->titre(), '</a></h4>', "\n",
                '<p>', nl2br($contenu), '</p>';
            }
        }
        ?>
    </body>
</html>