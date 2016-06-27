<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Page d'inscription</title>
    </head>
    <body>
        <form action="inscription.php" method="post">
            <p>
            	<label>Pseudo : <input type="text" name="pseudo"/></label>
            </p>
            <p>
                <label>Mot de passe : <input type="password" name="motDePasse"/></label>
            </p>
            <p>
            	<label>Retapez votre mot de passe : <input type="password" name="confirmationMotDePasse" /></label>
        	</p>
            <p>
                <label>Adresse email : <input type="text" name="eMail" /></label>
            </p>
        	<p>
            	<input type="submit" value="S'inscrire"/>
            </p>
        </form>
    </body>
</html>