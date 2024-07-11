<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

$conn = new mysqli('localhost', 'root', '', 'gestion_courrier');

if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

$courriers = $conn->query("SELECT * FROM courrier ORDER BY signature_date DESC, signature_numero DESC");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voir tous les courriers</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Voir tous les courriers</h1>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Contenu</th>
                    <th>Date de réception</th>
                    <th>État</th>
                    <th>Réponse</th>
                   
                </tr>
            </thead>
            <tbody>
                <?php while ($courrier = $courriers->fetch_assoc()): ?>
                    <tr>
                        <td><?= $courrier['id'] ?></td>
                        <td><?= $courrier['type'] ?></td>
                        <td><?= $courrier['contenu'] ?></td>
                        <td><?= $courrier['date_reception'] ?></td>
                        <td><?= $courrier['etat'] ?></td>
                        <td><?= $courrier['reponse'] ?></td>
                      
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
