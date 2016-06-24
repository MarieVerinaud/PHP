<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="vue/styles.css">
        <title>Mon super blog</title>
    </head>
    <body>
        <h1> Mon super blog !</h1>
        <p>Derniers billets du blog :</p>

        <?php
        include_once('modele/connexion_sql.php');       

        include_once('modele/get_nombre_billets.php');
        
        $nbBillet = (int)get_nombre_billets();
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

        include_once('modele/get_billets.php');

        $billets = get_billets((($cPage-1)*$perPage), $perPage);

        foreach($billets as $cle => $billet)
        {
            $billets[$cle]['titre'] = htmlspecialchars($billet['titre']);
            $billets[$cle]['contenu'] = nl2br(htmlspecialchars($billet['contenu']));
        }

        foreach($billets as $billet) 
        {
        ?>
        <article class="news">
            <h3><?php echo $billet['titre']. "<em> le " . $billet['date_creation'] . "</em>"; ?></h3>
            <p><?php echo $billet['contenu']; ?></br>
            <em><a href="commentaires.php?ID=<?php echo $billet['id']; ?>">Commentaires</a></em>
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
                echo " <a href=\"index.php?p=$i\">$i</a> /";
            }
        }          
        ?>
                
    </body>
</html>