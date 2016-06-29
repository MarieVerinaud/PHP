<?php 
include_once ('header.php');
include_once (__DIR__ . '/../controller/connexion_auto.php');

$hasPseudo = isset($_SESSION['pseudo']);
$pseudo = $hasPseudo ? $_SESSION['pseudo'] : "";

$hasEmail = isset($_SESSION['eMail']);
$eMail = $hasEmail ? $_SESSION['eMail'] : "";

$hasMessage = isset($_SESSION['message']);
$message = $hasMessage ? $_SESSION['message'] : "";
if ($hasMessage)
{
    unset($_SESSION['message']);
}

?>
    <form action="register.php" method="post">
        <p>
        	<label>Pseudo : <input type="text" name="pseudo" value="<?php echo $pseudo; ?>" required/></label>
        </p>
        <p>
            <label>Mot de passe : <input type="password" name="motDePasse" required/></label>
        </p>
        <p>
        	<label>Retapez votre mot de passe : <input type="password" name="confirmationMotDePasse" required/></label>
    	</p>
        <p>
            <label>Adresse email : <input type="email" name="eMail" value ="<?php echo $eMail ?>" required/></label>
        </p>
    	<p>
        	<button type="submit" class="btn btn-primary">S'inscrire</button> 
        </p>
    </form>    

    <pre><?php echo $message; ?></pre>

<?php include_once ('footer.php'); ?>
    