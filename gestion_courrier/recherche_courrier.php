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

$courrier = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);

    $sql = "SELECT * FROM courrier WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $courrier = $result->fetch_assoc();
    } else {
        $errorMessage = "Aucun courrier trouvé avec cet ID.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher un courrier</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Rechercher un courrier</h1>
        <?php if (isset($errorMessage)): ?>
            <div class="alert alert-danger"><?= $errorMessage ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="form-group">
                <label>ID du courrier :</label>
                <input type="number" name="id" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>
        <?php if ($courrier): ?>
            <div class="mt-5">
                <h2>Détails du courrier</h2>
                <p><strong>ID:</strong> <?= $courrier['id'] ?></p>
                <p><strong>Type:</strong> <?= $courrier['type'] ?></p>
                <p><strong>Contenu:</strong> <?= $courrier['contenu'] ?></p>
                <p><strong>Date de réception:</strong> <?= $courrier['date_reception'] ?></p>
                <p><strong>État:</strong> <?= $courrier['etat'] ?></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
