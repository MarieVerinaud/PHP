<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mini-chat</title>
    </head>
    <body>
        <form action="minichat_post.php" method="post">
            <p>
            	<label>Pseudo : <input type="text" name="pseudo" /></label>
        	</p>
        	<p>
            	<label>Message : <input type="text" name="message" /></label></br>
        	</p>
        	<p>
            	<input type="submit" value="Envoyer" />
            </p>
        </form>
        <?php
        $bdd = new PDO('mysql:host=localhost;dbname=cours_php', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $requete_recup = $bdd->query('SELECT * FROM mini_chat ORDER BY ID DESC LIMIT 0,10' );
		while($donnees = $requete_recup->fetch())
		{
			?>
			    <p>
			    <strong><?php echo $donnees['pseudo']; ?></strong> (<?php echo $donnees['heure']; ?>) : <?php echo $donnees['message']; ?>
			   </p>
			<?php
		}
		
		$requete_recup->closeCursor();
		?>
    </body>
</html>