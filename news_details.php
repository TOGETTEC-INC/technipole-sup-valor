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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="./assets/favicon-1.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <style>
        /* Couleur orange similaire à Y Combinator */
        .bg-orange {
            background-color: #FF6600 !important;
        }

        .text-orange, .text-muted {
            color: #FF6600 !important;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
        }

        /* On peut ajuster la couleur de fond si on veut un effet légèrement crème */
        .bg-cream, .text-muted {
            background-color: #f7f7f5;
        }

        a {
            text-decoration: none;
            color: #FF6600;
        }
    </style>

</head>
<body>
    <!-- Top Bar -->
    <div class="bg-orange text-center text-white py-2">
        <a href="#" class="text-white text-decoration-none fw-bold">
            Apply for the first-ever Sup Valor Spring batch
        </a>
    </div>

    <!-- Navbar -->
    <?php include 'components/header.php'; ?>

    <!-- Hero Section -->
    <div class="container my-5">
        <h1 class="text-orange mb-4"><?php echo htmlspecialchars($news['title']); ?></h1>

        <!-- Image -->
        <?php if (!empty($news['image'])): ?>
            <img src="./admin/<?php echo htmlspecialchars($news['image']); ?>" 
                class="img-fluid rounded mb-4" 
                alt="<?php echo htmlspecialchars($news['title']); ?>">
        <?php endif; ?>

        <!-- Contenu -->
        <p>
            <?php echo nl2br(htmlspecialchars_decode($news['content'])); ?>
        </p>

        <!-- Date -->
        <p class="text-muted mt-4">
            Publié le : <?php echo date('d/m/Y à H:i', strtotime($news['created_at'])); ?>
        </p>

    </div>

    <?php include 'components/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
