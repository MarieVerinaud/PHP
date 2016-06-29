<?php 
include_once ('header.php');
include_once (__DIR__ . '/../controller/connexion_auto.php');

$hasConnexion = isset($_SESSION['id']) AND isset($_SESSION['pseudo']);
?>
<div class="container">
    <h5>Bienvenue dans l'espace réservé aux membres !</h5>

    <?php
    if ($hasConnexion)
    {
    echo 'Bonjour ' . $_SESSION['pseudo'];
    ?>
    <br>
    <a href="../controller/deconnexion.php"><button>Deconnexion</button></a>
    <?php
    }
    else
    {
        ?>
        <a href="login.php"><button>Déjà inscrit ?</button></a>
        <a href="index.php"><button>S'inscrire</button></a>
        <?php
    }
    ?>
    
     
</div>

<?php include_once ('footer.php'); ?>