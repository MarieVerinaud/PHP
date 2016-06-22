<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="styles.css">
        <title>Mon super blog</title>
    </head>
    <body>
        <h1> Mon super blog !</h1>
        <a href="index.php">Retour à la liste des billets</a>
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
        
        if (isset($_GET['ID']) AND $_GET['ID']>0 AND $_GET['ID'] <= $nbBillet)
        {
            $id_commentaire = $_GET['ID'];
        }
        else
        {
            $id_commentaire = 1;
        }

        $requete_nb->closeCursor();
              

        $requete_recup = $bdd->query("SELECT titre, contenu, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS date FROM billets WHERE id = '$id_commentaire'");

        $donnees = $requete_recup->fetch();
        ?>
        <article class="news">
        <h3><?php echo htmlspecialchars($donnees['titre']). "<em> le " . $donnees['date'] . "</em>"; ?></h3>
        <p><?php echo htmlspecialchars_decode($donnees['contenu']); ?></p>
        </article>
        
            
        <?php
        $requete_recup->closeCursor();
        ?>
        <h2>Commentaires : </h2>
        <?php

        $requete_recup = $bdd->query("SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, '%d/%m/%Y à %Hh%imin%ss') AS date FROM commentaires WHERE id_billet = '$id_commentaire'");
        while($donnees = $requete_recup->fetch())
        {
            ?>               
               <p><strong><?php echo htmlspecialchars($donnees['auteur']) . "</strong> le " . htmlspecialchars($donnees['date']); ?></p>
               <p><?php echo htmlspecialchars($donnees['commentaire']); ?></p>
            <?php
        }        
        
        $requete_recup->closeCursor();
        ?>
        <h2>Rajouter un commentaire :</h2>
        <form method='post' <?php echo "action='commentaires_post.php?ID=$id_commentaire'>"; ?>
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