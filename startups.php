<?php
// Charger la connexion PDO
require_once './admin/config/database.php';

// Récupérer les startups depuis la base de données
$sql = "SELECT id, name, logo, description, website FROM startups ORDER BY id DESC";
$stmt = $pdo->query($sql);
$startups = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Startups</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="./assets/favicon-1.png" />

    <style>
        /* Couleur orange similaire à Y Combinator */
        .bg-orange {
            background-color: #FF6600 !important;
        }
        .text-orange {
            color: #FF6600 !important;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
        }
        .bg-cream {
            background-color: #f7f7f5;
        }
        .startup-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .startup-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
        }
        .startup-logo {
            max-height: 100px;
            object-fit: contain;
        }
    </style>
</head>
<body>
   
    <!-- Navbar -->
    <?php include 'components/header.php'; ?>

    <!-- Hero Section -->
    <section class="bg-orange text-white text-center py-5">
        <div class="container">
            <h1 class="display-4 fw-bold">Découvrez Nos Startups</h1>
            <p class="lead">Une collection de startups innovantes incubées et soutenues par le Technipole Sup Valor.</p>
        </div>
    </section>

    <!-- Startups Section -->
    <section class="container my-5">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <?php if (!empty($startups)): ?>
                <?php foreach ($startups as $startup): ?>
                    <div class="col">
                        <div class="card startup-card h-100">
                            <!-- Logo -->
                            <?php if (!empty($startup['logo'])): ?>
                                <img src="./admin/uploads/startups/<?php echo htmlspecialchars($startup['logo']); ?>" 
                                     class="card-img-top startup-logo p-3" 
                                     alt="<?php echo htmlspecialchars($startup['name']); ?>">
                            <?php else: ?>
                                <img src="assets/images/placeholder.jpg" 
                                     class="card-img-top startup-logo p-3" 
                                     alt="Logo non disponible">
                            <?php endif; ?>

                            <!-- Contenu -->
                            <div class="card-body">
                                <h5 class="card-title text-orange"><?php echo htmlspecialchars($startup['name']); ?></h5>
                                <p class="card-text text-muted">
                                    <?php echo htmlspecialchars(substr($startup['description'], 0, 100)) . '...'; ?>
                                </p>
                                <!-- Bouton pour plus d'informations -->
                                <!-- <a href="startup_detail.php?id=<?php echo $startup['id']; ?>" 
                                   class="btn btn-outline-orange btn-sm">
                                    En savoir plus
                                </a> -->
                            </div>

                            <!-- Footer de la carte -->
                            <div class="card-footer bg-white text-center">
                                <?php if (!empty($startup['website'])): ?>
                                    <a href="<?php echo htmlspecialchars($startup['website']); ?>" 
                                       class="text-orange" target="_blank" rel="noopener noreferrer">
                                        <i class="fas fa-link"></i> Visiter le site
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">Site web non disponible</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">Aucune startup disponible pour le moment.</p>
            <?php endif; ?>
        </div>
    </section>

    <?php include 'components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
