<?php
session_start();
include_once(__DIR__ . '/../model/BDD.class.php');
include_once(__DIR__ . '/../model/Membre.class.php');

class MembresController
{

    /**
     * Cette fonction va vérifier la saisie des champs
     */
    public function verificationSaisie(){

        if(isset($_POST["pseudo"])&& isset($_POST["eMail"]) && isset($_POST["motDePasse"]) && isset($_POST["confirmationMotDePasse"])){

            $pseudo = htmlspecialchars($_POST["pseudo"]);
            $eMail = htmlspecialchars($_POST["eMail"]);
            $motDePasse = htmlspecialchars($_POST["motDePasse"]);
            $confirmationMotDePasse = htmlspecialchars($_POST["confirmationMotDePasse"]);


            if($this->alreadyRegistered($pseudo) === true){
                $_SESSION['message'] = "Vous êtes déjà inscrit(e) !";
                header('Location: index.php');
            }else{
                $this->inscrireUnMembre($pseudo, $eMail, $motDePasse, $confirmationMotDePasse);
            }

        }else{
            $_SESSION['message'] = "Vous n'avez pas saisi tous les champs";
        }

    }

    /**
     * Cette fonction va permettre de vérifier si l'utilisateur est enregistré
     * ou pas.
     * @param $pseudo
     * @return bool
     */
    public function alreadyRegistered($pseudo){

        try
        {
            //ça c'est moche, faudrait une seule connexion par requête du coup
            $bdd = (new BDD())->getConnexion();
            $reponse = $bdd->prepare('SELECT pseudo FROM membres WHERE pseudo = :pseudo');
            $reponse->execute(array(
                'pseudo' => $pseudo
            ));
            $login = $reponse->fetch();

            if (strtolower($pseudo) == strtolower($login['pseudo']))
            {
                return true;
            }
            $reponse->closeCursor();
        }
        catch (Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }

        return false;
    }

    /**
     * Après la vérification de la saisie, tu peux faire une inscription
     * @param $pseudo
     * @param $eMail
     * @param $motDePasse
     * @param $confirmationMotDePasse
     */
    public function inscrireUnMembre($pseudo, $eMail, $motDePasse, $confirmationMotDePasse)
    {

        $erreur = '';
        $membre = new Membre();
        $bdd = (new BDD())->getConnexion();

        //On hydrate notre objet
        $membre->setPseudo($pseudo);


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


        if(!$erreur){

            $req = $bdd->prepare('INSERT INTO membres(pseudo, pass, email, date_inscription) VALUES(:pseudo, :pass, :email, CURDATE())');

            $req->execute(array(
                'pseudo' => $membre->getPseudo(),
                'pass' => $membre->getMotdePasse(),
                'email' => $membre->getEmail()));

            $req-> closeCursor();
            $_SESSION['message'] = "Votre compte a bien été crée";

        }else{
            $_SESSION['message'] = "Merci de vérifier votre saisie.";
        }
        header('Location: index.php');
    }
}