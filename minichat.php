<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mini-chat</title>
    </head>
    <body>
        <form action="minichat_post.php" method="post">
            <p>
            	<?php
                if (isset($_GET['pseudo']))
                {
                ?>
                    <label>Pseudo : <input type="text" name="pseudo" value=<?php echo $_GET['pseudo']?>></label>
            </p>
                <?php
                }
                else
                {
                ?>
                    <label>Pseudo : <input type="text" name="pseudo" value="" /></label>
            </p>
                <?php
                }
                ?>

        	<p>
            	<label>Message : <input type="text" name="message" /></label></br>
        	</p>
        	<p>
            	<input type="submit" value="Envoyer"/>
                <input type="button" value="Rafraîchir" onclick="window.location.reload(false)"/>
            </p>
        </form>
        <?php
        $bdd = new PDO('mysql:host=localhost;dbname=cours_php', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        
        $requete_nb = $bdd->query('SELECT COUNT(ID) AS nbArt FROM mini_chat');
        $data = $requete_nb->fetch();

        $nbArt = $data['nbArt'];
        $perPage = 10;
        $nbPage = ceil($nbArt/$perPage);

        if (isset($_GET['p']) AND $_GET['p']>0 AND $_GET['p'] <= $nbPage)
        {
            $cPage = $_GET['p'];
        }
        else
        {
            $cPage = 1;
        }
        $requete_nb->closeCursor();

        $requete_recup = $bdd->query("SELECT * FROM mini_chat ORDER BY ID DESC LIMIT ".(($cPage-1)*$perPage).",$perPage");
		while($donnees = $requete_recup->fetch())
		{
			?>
			    <p>
			    <strong><?php echo $donnees['pseudo']; ?></strong> (<?php echo $donnees['heure']; ?>) : <?php echo $donnees['message']; ?>
			   </p>
			<?php
		}

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