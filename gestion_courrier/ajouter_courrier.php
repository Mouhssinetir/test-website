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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = $conn->real_escape_string($_POST['type']);
    $contenu = $conn->real_escape_string($_POST['contenu']);
    $date_reception = date('Y-m-d');
    $etat = 'En attente';

    $sql = "INSERT INTO courrier (type, contenu, date_reception, etat) VALUES ('$type', '$contenu', '$date_reception', '$etat')";
    
    if ($conn->query($sql) === TRUE) {
        $successMessage = "Courrier ajouté avec succès!";
    } else {
        $errorMessage = "Erreur: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un courrier</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ajouter un courrier</h1>
        <?php if (isset($successMessage)): ?>
            <div class="alert alert-success" role="alert">
                <?= $successMessage ?>
            </div>
        <?php elseif (isset($errorMessage)): ?>
            <div class="alert alert-danger" role="alert">
                <?= $errorMessage ?>
            </div>
        <?php endif; ?>
        <form method="post">
            <div class="form-group">
                <label>Type de courrier :</label>
                <select name="type" class="form-control" required>
                    <option value="FAX">FAX</option>
                    <option value="POSTE">POSTE</option>
                    <option value="DEPOT PHYSIQUE">DEPOT PHYSIQUE</option>
                    <option value="MAIL">MAIL</option>
                </select>
            </div>
            <div class="form-group">
                <label>Contenu :</label>
                <textarea name="contenu" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
</body>
</html>
