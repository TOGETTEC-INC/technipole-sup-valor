<?php
// startup_detail.php

require_once './admin/config/database.php'; // Connexion $pdo

// Vérifier si un paramètre 'id' est présent dans l'URL
if (!isset($_GET['id'])) {
    die('ID de startup manquant');
}

// Convertir l’ID en entier pour éviter toute injection
$startupId = (int) $_GET['id'];

// Requête pour récupérer la startup
$sql = "SELECT * FROM startups WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $startupId, PDO::PARAM_INT);
$stmt->execute();
$startup = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si la startup existe
if (!$startup) {
    die('Startup introuvable');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Détail de la Startup</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
<div class="container my-5">
  <h1><?php echo htmlspecialchars($startup['name']); ?></h1>

  <!-- Affichage du logo -->
  <?php if (!empty($startup['logo'])): ?>
    <img 
      src="<?php echo htmlspecialchars($startup['logo']); ?>" 
      alt="Logo <?php echo htmlspecialchars($startup['name']); ?>"
      style="max-height: 100px;"
    >
  <?php else: ?>
    <p><em>Aucun logo disponible</em></p>
  <?php endif; ?>

  <!-- Description -->
  <?php if (!empty($startup['description'])): ?>
    <p class="mt-3">
      <?php echo nl2br(htmlspecialchars($startup['description'])); ?>
    </p>
  <?php endif; ?>

  <!-- Site web -->
  <?php if (!empty($startup['website'])): ?>
    <p>
      Site web : 
      <a href="<?php echo htmlspecialchars($startup['website']); ?>" target="_blank" rel="noopener noreferrer">
        <?php echo htmlspecialchars($startup['website']); ?>
      </a>
    </p>
  <?php endif; ?>

  <!-- Autres infos (ex: date création, statut) -->
  <p class="text-muted">
    <?php if (!empty($startup['created_at'])): ?>
      Créée le : <?php echo $startup['created_at']; ?>
    <?php endif; ?>
    <br>
    Statut : <?php echo $startup['status'] ?? 'N/A'; ?>
  </p>

  <a href="./" class="btn btn-secondary mt-4">Revenir à l'accueil</a>
</div>

</body>
</html>
