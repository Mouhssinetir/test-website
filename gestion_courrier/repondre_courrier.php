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
    $id = intval($_POST['id']);
    $reponse = $conn->real_escape_string($_POST['reponse']);

    $sql = "UPDATE courrier SET reponse='$reponse' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        $successMessage = "Réponse envoyée avec succès!";
    } else {
        $errorMessage = "Erreur: " . $conn->error;
    }
}

$courriers = $conn->query("SELECT * FROM courrier WHERE etat NOT LIKE 'En attente'");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Répondre à un courrier</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Répondre à un courrier</h1>
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
                <label>ID du courrier :</label>
                <select name="id" class="form-control" required>
                    <?php while ($courrier = $courriers->fetch_assoc()): ?>
                        <option value="<?= $courrier['id'] ?>"><?= $courrier['id'] ?> - <?= $courrier['contenu'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Réponse :</label>
                <textarea name="reponse" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer la réponse</button>
        </form>
    </div>
</body>
</html>
