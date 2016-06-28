<?php include_once ('header.php') ?>
<div class="container">
    <h5>Bienvenue dans l'espace réservé aux membres !</h5>

    <?php 

    if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
    {
    echo 'Bonjour ' . $_SESSION['pseudo'];
    }
    <a href="login.php"><button>Déjà inscrit ?</button></a>
    <a href="index.php"><button>S'inscrire</button></a>
    <a href="deconnexion.php"><button>Deconnexion</button></a>  
</div>

<?php include_once ('footer.php') ?>