<?php
session_start();
if (!isset($_SESSION['connecte']) || $_SESSION['connecte'] !== true) {
    header("Location: login.php");
    exit();
}

$connexion = mysqli_connect("localhost", "suau", "passroot", "sae23");
if (!$connexion) {
    die("Erreur de connexion à la base : " . mysqli_connect_error());
}

// Récupérer les 5 dernières mesures E101 (id_capteur = 1)
$sql_e101 = "SELECT * FROM mesures WHERE id_capteur = 1 ORDER BY id_mesure DESC LIMIT 5";
$result_e101 = mysqli_query($connexion, $sql_e101);
$e101_data = mysqli_fetch_all($result_e101, MYSQLI_ASSOC);

// Récupérer les 5 dernières mesures E208 (id_capteur = 2)
$sql_e208 = "SELECT * FROM mesures WHERE id_capteur = 2 ORDER BY id_mesure DESC LIMIT 5";
$result_e208 = mysqli_query($connexion, $sql_e208);
$e208_data = mysqli_fetch_all($result_e208, MYSQLI_ASSOC);

mysqli_close($connexion);
?>


<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Données metriques</title>
        <link rel="stylesheet" href="style.css"> <!-- Link the css file -->
    </head>

    <body>
        <header>
            <h1>Données metriques <strong>SAE23</strong></h1> <!-- header of the page -->
        </header>

		<nav class="nav-bar">
    <ul class="nav-pages">
        <li><a href="acceuil.html">Accueil</a></li>
        <li><a href="logoff.php">Déconnexion</a></li>
    </ul>
</nav>

<section>
    <h2>Tableau de luminosité de la salle E101</h2>
    <?php if (!empty($e101_data)) : ?>
        <p>Dernière donnée enregistrée le <?= $e101_data[0]['date'] ?> à <?= $e101_data[0]['heure'] ?></p>
        <table>
            <tr>
                <th>Average</th>
                <th>Min</th>
                <th>Max</th>
            </tr>
            <tr>
                <td><?= $e101_data[0]['avg_valeur'] ?></td>
                <td><?= $e101_data[0]['min_valeur'] ?></td>
                <td><?= $e101_data[0]['max_valeur'] ?></td>
            </tr>
        </table>
        <p>Les 5 dernières valeurs enregistrées :</p>
        <table>
            <tr>
                <th>Date</th>
                <th>Heure</th>
                <th>Valeur</th>
            </tr>
            <?php foreach ($e101_data as $mesure) : ?>
                <tr>
                    <td><?= $mesure['date'] ?></td>
                    <td><?= $mesure['heure'] ?></td>
                    <td><?= $mesure['valeur'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p>Aucune donnée enregistrée pour E101.</p>
    <?php endif; ?>
</section>

<section id="last">
    <h2>Tableau de luminosité de la salle E208</h2>
    <?php if (!empty($e208_data)) : ?>
        <p>Dernière donnée enregistrée le <?= $e208_data[0]['date'] ?> à <?= $e208_data[0]['heure'] ?></p>
        <table>
            <tr>
                <th>Average</th>
                <th>Min</th>
                <th>Max</th>
            </tr>
            <tr>
                <td><?= $e208_data[0]['avg_valeur'] ?></td>
                <td><?= $e208_data[0]['min_valeur'] ?></td>
                <td><?= $e208_data[0]['max_valeur'] ?></td>
            </tr>
        </table>
        <p>Les 5 dernières valeurs enregistrées :</p>
        <table>
            <tr>
                <th>Date</th>
                <th>Heure</th>
                <th>Valeur</th>
            </tr>
            <?php foreach ($e208_data as $mesure) : ?>
                <tr>
                    <td><?= $mesure['date'] ?></td>
                    <td><?= $mesure['heure'] ?></td>
                    <td><?= $mesure['valeur'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p>Aucune donnée enregistrée pour E208.</p>
    <?php endif; ?>
</section>

<footer>
    <ul>
        <li><a class="sites" href="https://www.iut-blagnac.fr/fr/">IUT de Blagnac</a></li>
        <li><a class="sites" href="https://www.iut-blagnac.fr/fr/formations/but-rt">Département Réseaux et Télécommunications</a></li>
        <li>BUT1</li>
    </ul>
</footer>
</body>
</html>
