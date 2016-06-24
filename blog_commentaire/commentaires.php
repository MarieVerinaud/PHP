<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="vue/styles.css">
        <title>Mon super blog</title>
    </head>
    <body>
        <h1> Mon super blog !</h1>
        <a href="index.php">Retour à la liste des billets</a>
        <?php
        include_once('modele/connexion_sql.php');
        include_once('modele/get_nombre_billets.php');

        $nbBillet = (int)get_nombre_billets();
        
        if (isset($_GET['ID']) AND $_GET['ID']>0 AND $_GET['ID'] <= $nbBillet)
        {
            $id_commentaire = $_GET['ID'];
        }
        else
        {
            $id_commentaire = 1;
        }    

        $requete_recup = $bdd->query("SELECT titre, contenu, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS date FROM billets WHERE id = '$id_commentaire'");

        $donnees = $requete_recup->fetch();
        ?>
        <article class="news">
        <h3><?php echo htmlspecialchars($donnees['titre']). "<em> le " . $donnees['date'] . "</em>"; ?></h3>
        <p><?php echo htmlspecialchars_decode($donnees['contenu']); ?></p>
        </article>
        
            
        <?php
        $requete_recup->closeCursor();

        include_once('modele/get_nombre_commentaires.php');
        
        $nbCommentaire = (int) get_nombre_commentaires($id_commentaire);
        $perPage = 5;
        $nbPage = ceil($nbCommentaire/$perPage);
        
        if (isset($_GET['p']) AND $_GET['p']>0 AND $_GET['p'] <= $nbPage)
        {
            $cPage = $_GET['p'];
        }
        else
        {
            $cPage = 1;
        }

        ?>


        <h2>Commentaires : </h2>
        <?php

        include_once('modele/get_commentaires.php');

        $commentaires = get_commentaires($id_commentaire, (($cPage-1)*$perPage), $perPage);

        foreach($commentaires as $cle => $commentaire)
        {
            $commentaires[$cle]['auteur'] = htmlspecialchars($commentaire['auteur']);
            $commentaires[$cle]['commentaire'] = nl2br(htmlspecialchars($commentaire['commentaire']));
        }

        foreach($commentaires as $commentaire) 
        {
        ?>
        <p><strong><?php echo $commentaire['auteur'] . "</strong> le " . $commentaire['date_commentaire']; ?></p>
        <p><?php echo $commentaire['commentaire']; ?></p>        
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
                echo " <a href=\"commentaires.php?ID=$id_commentaire&p=$i\">$i</a> /";
            }
        }       
        ?>
        <h2>Rajouter un commentaire :</h2>
        <form method='post' <?php echo "action='commentaires_post.php?ID=$id_commentaire'"; ?>>
            <p>
                <label>Pseudo : <input type="text" name="pseudo" /></label></br>
                <label>Commentaire : <input type="text" name="commentaire" /></label>
            </p>
            <p>
                <input type="submit" value="Envoyer" />
            </p>
        </form>
                
    </body>
</html>