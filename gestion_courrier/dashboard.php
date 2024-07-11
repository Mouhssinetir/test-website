<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
        }
        .sidebar a {
            padding: 15px;
            text-align: center;
            display: block;
            color: white;
            text-decoration: none;
            margin-bottom: 10px;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .navbar-brand {
            margin-left: 250px;
        }
        .container-fluid {
            padding: 0 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="#">AGENCE URBAINE BERRECHID BENSLIMANE</a>
        <form class="form-inline">
            <a class="btn btn-outline-danger" href="logout.php">Déconnexion</a>
        </form>
    </nav>
    
    <div class="sidebar">
        <a href="ajouter_courrier.php">Ajouter un courrier</a>
        <a href="diriger_courrier.php">Diriger un courrier</a>
        <a href="mettre_a_jour_courrier.php">Mettre à jour un courrier</a>
        <a href="recherche_courrier.php" >Rechercher un courrier</a>
        <a href="repondre_courrier.php">Répondre à un courrier</a>
        <a href="supprimer_courrier.php">Supprimer un courrier</a>
        <a href="voir_courrier.php">Voir tous les courriers</a>
    </div>
    
    <div class="content">
        <div class="container-fluid">
            <h1 class="mt-4">Bienvenue à l'AGENCE URBAINE BERRECHID BENSLIMANE</h1>
            <p>Ceci est la page principale après la connexion.</p>
        </div>
    </div>
</body>
</html>
