<?php
session_start();
$erreur = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $mdp = $_POST['mdp'];

    $connexion = mysqli_connect("localhost", "suau", "passroot", "sae23");
    if (!$connexion) {
        die("Erreur de connexion à la base : " . mysqli_connect_error());
    }

	$sql_gestion = "SELECT * FROM gestionnaires WHERE login = '$login' AND mdp = '$mdp'";
    $result_gestion = mysqli_query($connexion, $sql_gestion);

    if (mysqli_num_rows($result_gestion) == 1) {
        $_SESSION['connecte'] = true;
        $_SESSION['role'] = 'gestionnaire';
        header("Location: index.php");
        exit();
    } else {
        $erreur = "Identifiants incorrects.";
    }

    mysqli_close($connexion);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

	<header>
        <h1>Une solution informatique pour l'entreprise ! <strong>SAe 23</strong></h1>
    </header>
    <nav class="nav-bar">
        <ul class="nav-pages">
            <li><a href="accueil.html">Accueil</a></li>
            <li class="dropdown"> <!-- création d'un menu déroulant pour la présentation -->
                <a class="dropbouton">Administration</a> <!-- Bouton principal -->
                <div class="dropdown-contenue"> <!-- Contenue du menu déroulant qui ne s'affichent que si on le survole avec le curseur -->
                    <a href="loginA.php">Modification des tables</a>
                    <a href="loginAA.php">Affichage de toute les salles</a>
                </div>
            </li>
            <li><a href="#">Gestion</a></li>
            <li><a href="consultation.php">Consultation</a></li>
            <li class="dropdown"> <!-- création d'un menu déroulant pour la présentation -->
                <a class="dropbouton">Gestion de Project</a> <!-- Bouton principal -->
                <div class="dropdown-contenue"> <!-- Contenue du menu déroulant qui ne s'affichent que si on le survole avec le curseur -->
                    <a href="livrables.html">Livrables</a>
                    <a href="gantt.html">Organisation du projet</a>
                    <a href="synthese.html">Synthèse personnelle</a>
                    <a href="problemes.html">Problèmes rencontrés</a>
                    <a href='satisfaction.html'>Degré de satisfaction</a>
                </div>
            </li>
        </ul>
    </nav>
<section>
    <h2>Connexion à la consultation des données métriques</h2>
    <p>Completez le formulaire ci-dessous pour vous authentifier. Seulement les gestionnaires peuvent accéder aux données.
    </p>
    <p>
        Si vous souhaitez prendre connaissance des dernières données enregistrées veuillez cliquer sur ce lien : <a href="consultation.php" class="sites">Consultation des données libre d'accès</a>
    </p>
    <form method="post" action="">
        <label>Login : <input type="text" name="login" required></label><br>
        <label>Mot de passe : <input type="password" name="mdp" required></label><br>
        <button type="submit">Se connecter</button>
    </form>
    <?php if ($erreur != "") echo "<p style='color:red;'>$erreur</p>"; ?>
</section>
    <footer>
        <ul>
            <li><a class="sites" href="https://www.iut-blagnac.fr/fr/">IUT de Blagnac</a></li>
            <li><a class="sites" href="https://www.iut-blagnac.fr/fr/formations/but-rt">Département Réseaux et Télécommunications</a></li>
            <li>BUT 1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
        </ul>
    </footer>
</body>
</html>
