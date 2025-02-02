<?php
require_once './admin/config/database.php';

// Vérifier si l'ID de l'actualité est passé en paramètre
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID d'actualité invalide.");
}

$newsId = (int)$_GET['id'];

// Récupérer les détails de l'actualité
$sql = "SELECT title, content, image, created_at FROM news WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $newsId, PDO::PARAM_INT);
$stmt->execute();
$news = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si l'actualité existe
if (!$news) {
    die("Actualité introuvable.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($news['title']); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container my-5">
    <h1 class="text-orange mb-4"><?php echo htmlspecialchars($news['title']); ?></h1>

    <!-- Image -->
    <?php if (!empty($news['image'])): ?>
        <img src="./admin/<?php echo htmlspecialchars($news['image']); ?>" 
             class="img-fluid rounded mb-4" 
             alt="<?php echo htmlspecialchars($news['title']); ?>">
    <?php endif; ?>

    <!-- Contenu -->
    <p><?php echo nl2br(htmlspecialchars($news['content'])); ?></p>

    <!-- Date -->
    <p class="text-muted mt-4">
        Publié le : <?php echo date('d/m/Y à H:i', strtotime($news['created_at'])); ?>
    </p>

    <!-- Bouton retour -->
    <a href="index.php" class="btn btn-secondary">Retour à l'accueil</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
