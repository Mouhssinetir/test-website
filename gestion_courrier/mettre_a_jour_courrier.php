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
    $contenu = $conn->real_escape_string($_POST['contenu']);
    $etat = $conn->real_escape_string($_POST['etat']);

    $sql = "UPDATE courrier SET contenu='$contenu', etat='$etat' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        $successMessage = "Courrier mis à jour avec succès!";
    } else {
        $errorMessage = "Erreur: " . $conn->error;
    }
}

$courriers = $conn->query("SELECT * FROM courrier");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mettre à jour un courrier</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Mettre à jour un courrier</h1>
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
                <label>Contenu :</label>
                <textarea name="contenu" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label>État :</label>
                <select name="etat" class="form-control" required>
                    <option value="En attente">En attente</option>
                    <option value="GESTION">GESTION</option>
                    <option value="ETUDE">ETUDE</option>
                    <option value="DAAF">DAAF</option>
                    <option value="ANTENNE">ANTENNE</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</body>
</html>
