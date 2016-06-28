<?php include_once ('header.php') ?>
    <form action="register.php" method="post">
        <p>
        	<label>Pseudo : <input type="text" name="pseudo" value="<?php if(isset($_POST['pseudo'])) {echo htmlspecialchars($_POST['pseudo']);} ?>" required/></label>
        </p>
        <p>
            <label>Mot de passe : <input type="password" name="motDePasse" required/></label>
        </p>
        <p>
        	<label>Retapez votre mot de passe : <input type="password" name="confirmationMotDePasse" required/></label>
    	</p>
        <p>
            <label>Adresse email : <input type="text" name="eMail" value ="<?php if(isset($_POST['eMail'])) echo $_POST['eMail']; ?>" required/></label>
        </p>
    	<p>
        	<button type="submit" class="btn btn-primary">S'inscrire</button> 
        </p>
    </form>    

    <pre><?php if (isset($_SESSION['message'])){echo $_SESSION['message'];} ?></pre>
<?php include_once ('footer.php') ?>
    