<?php

include_once(__DIR__ . '/../model/BDD.class.php');
include_once(__DIR__ . '/../model/Membre.class.php');

class MembresController
{    
    public function inscrireUnMembre()
    {
        session_start();
        $pseudo = htmlspecialchars($_POST["pseudo"]);
        $eMail = htmlspecialchars($_POST["eMail"]);
        $motDePasse = htmlspecialchars($_POST["motDePasse"]);
        $confirmationMotDePasse = htmlspecialchars($_POST["confirmationMotDePasse"]);


        $erreur = '';
        $membre = new Membre();
        $bdd = (new BDD())->getConnexion();

        // Vérification si pseudo déjà utilisé
        try 
        {
            $reponse = $bdd->prepare('SELECT pseudo FROM membres WHERE pseudo = :pseudo');
            $reponse->execute(array(
            'pseudo' => $pseudo
            ));
            $login = $reponse->fetch();
        } 
        catch (Exception $e) 
        {
            die('Erreur : '.$e->getMessage());
        }

        if (strtolower($pseudo) == strtolower($login['pseudo']))
        {
            $erreur = "Ce pseudo est déjà utilisé.";
            $_SESSION['message'] = $erreur;
            header('Location: index.php');
        }
        else
        {
            $membre->setPseudo($pseudo);
        }


        if (!$membre->setEmail($eMail))
        {
            $erreur = "L'email n'est pas valide.";
            $_SESSION['message'] = $erreur;
            header('Location: index.php');
        }

        if(!$membre->setMotDePasse($motDePasse) AND $motDePasse!= $confirmationMotDePasse)
        {
            $erreur = "Le mot de passe n'est pas valide.";
            $_SESSION['message'] = $erreur;
            header('Location: index.php');
        }

        $reponse->closeCursor();

        $req = $bdd->prepare('INSERT INTO membres(pseudo, pass, email, date_inscription) VALUES(:pseudo, :pass, :email, CURDATE())');

        $req->execute(array(
            'pseudo' => $membre->pseudo,
            'pass' => $membre->pass,
            'email' => $membre->email));

        $req-> closeCursor();

        header('Location: index.php');
    }
}