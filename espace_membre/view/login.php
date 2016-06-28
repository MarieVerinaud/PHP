<?php include_once ('header.php') ?>
    <form action="connect.php" method="post">
        <p class="form-group">
        	<label>Pseudo : <input type="text" name="pseudo" value="<?php if(isset($_SESSION['pseudo'])) {echo htmlspecialchars($_SESSION['pseudo']);} ?>" required/></label>
        </p>
        <p class="form-group">
            <label>Mot de passe : <input type="password" name="motDePasse" required/></label>
        </p>
        <p class="form-group">
        	<label>Connexion automatique : <input type="checkbox" name="connexion_auto"/></input>
    	</p>
    	<p>
        	<button type="submit" class="btn btn-primary">Connexion</button> 
        </p>
    </form>    

    <pre>
        <?php if (isset($_SESSION['message'])):?>
            <?php echo($_SESSION['message']);?>
        <?php endif;?>
    </pre>
<?php include_once ('footer.php') ?>