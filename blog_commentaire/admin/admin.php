<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Administration de mon super blog</title>
    </head>
    <body>
        <h1> Administration de mon super blog !</h1>
        <h2>
            <a href="ajouter.php">Ajouter un nouveau billet :</a>
        </h2>
        
        <?php
        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=cours_php;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        catch (Exception $e)
        {
                die('Erreur : ' . $e->getMessage());
        }

        $requete_recup = $bdd->query("SELECT id, titre, contenu, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS date_creation 
            FROM billets ORDER BY ID DESC");
            ?>
        <table>
            <tr>
                <th>Modifier</th>
                <th>Supprimer</th>
                <th>Titre</th>
                <th>Contenu</th>
                <th>Date</th>
            </tr>
        <?php
        while ($donnees = $requete_recup->fetch())
        {
            ?>            
                <tr>
                    <td><a href='modifier.php?id=<?php echo $donnees['id']; ?>'>Modifier</a></td>
                    <td><a href='supprimer.php?id=<?php echo $donnees['id']; ?>' onclick="return confirm('Etes-vous sûr ?')">Supprimer</a></td>
                    <td><?php echo htmlspecialchars_decode($donnees['titre']); ?></td>
                    <td><?php echo htmlspecialchars_decode($donnees['contenu']); ?></td>
                    <td><?php echo htmlspecialchars_decode($donnees['date_creation']); ?></td>
                </tr>           
            <?php
        }
        ?>
        </table>        
                
    </body>
</html>