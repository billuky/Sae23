<?php
$conn = mysqli_connect("localhost", "suau", "passroot", "sae23");
if (!$conn) {
    die("Erreur de connexion à la base : " . mysqli_connect_error());
}

$e101 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM mesures WHERE id_capteur = 1 ORDER BY id_mesure DESC LIMIT 1"));
$e208 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM mesures WHERE id_capteur = 2 ORDER BY id_mesure DESC LIMIT 1"));

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation des données</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
        <header>
            <h1>Dernières mesures de luminosité – SAE 23</h1>
        </header>

    <!-- Navigation stylisée -->
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
            <li><a href="index.php">Gestion</a></li>
            <li><a href="consultation.php">Consultation</a></li>
            <li class="dropdown"> <!-- création d'un menu déroulant pour la présentation -->
                <a class="dropbouton">Gestion de Project</a> <!-- Bouton principal -->
                <div class="dropdown-contenue"> <!-- Contenue du menu déroulant qui ne s'affichent que si on le survole avec le curseur -->
                    <a href="livrables.html">Livrables</a>
                    <a href="gantt.html">Organisation du projet</a>
                    <a href="synthese.html">Synthèse personnelle</a>
                    <a href="problemes.html">Problèmes rencontrés</a>
                    <a href="satisfaction.html">Degré de satisfaction</a>
                </div>
            </li>
        </ul>
    </nav>

    <section>
        <h2>Salle E101</h2>
        <p>Mesure du <?= $e101['date'] ?> à <?= $e101['heure'] ?></p>
        <p><strong>Valeur :</strong> <?= $e101['valeur'] ?> lux</p>
    </section>

    <section>
        <h2>Salle E208</h2>
        <p>Mesure du <?= $e208['date'] ?> à <?= $e208['heure'] ?></p>
        <p><strong>Valeur :</strong> <?= $e208['valeur'] ?> lux</p>
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