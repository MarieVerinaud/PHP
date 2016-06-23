<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="styles.css">
        <title>Mon super blog</title>
    </head>
    <body>
        <h1> Mon super blog !</h1>
        <p>Derniers billets du blog :</p>
        <?php
        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=cours_php;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        catch (Exception $e)
        {
                die('Erreur : ' . $e->getMessage());
        }        

        $requete_nb = $bdd->query("SELECT COUNT(*) AS nbBillet FROM billets");
        $data = $requete_nb->fetch();

        $nbBillet = $data['nbBillet'];
        $perPage = 5;
        $nbPage = ceil($nbBillet/$perPage);
        
        if (isset($_GET['p']) AND $_GET['p']>0 AND $_GET['p'] <= $nbPage)
        {
            $cPage = $_GET['p'];
        }
        else
        {
            $cPage = 1;
        }

        $requete_recup = $bdd->query("SELECT id, titre, contenu, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS date 
            FROM billets ORDER BY ID DESC LIMIT ".(($cPage-1)*$perPage).",$perPage");

        while ($donnees = $requete_recup->fetch())
        {
            ?>
            <article class="news">
            <h3><?php echo htmlspecialchars($donnees['titre']). "<em> le " . $donnees['date'] . "</em>"; ?></h3>
            <p><?php echo htmlspecialchars_decode($donnees['contenu']); ?></br>
            <em><a href="commentaires.php?ID=<?php echo $donnees['id']; ?>">Commentaires</a></em>
            </p>
            </article>
            <?php
        }
        echo "Page :";
        for($i=1 ; $i<=$nbPage ; $i++)
        {
            if ($i==$cPage)
            {
                echo " $i /";
            }
            else
            {
                echo " <a href=\"minichat.php?p=$i\">$i</a> /";
            }
        }          
        
        $requete_recup->closeCursor();
        ?>
                
    </body>
</html>