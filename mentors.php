<?php
// Charger la connexion PDO
require_once './admin/config/database.php';

// Récupérer les mentors depuis la base de données
$sql = "SELECT name, expertise, bio, photo, linkedin FROM mentors ORDER BY name ASC";
$stmt = $pdo->query($sql);
$mentors = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Mentors</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="./assets/favicon-1.png" />
    <style>
        .bg-orange {
            background-color: #FF6600 !important;
        }
        .text-orange {
            color: #FF6600 !important;
        }
        .mentor-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .mentor-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
        }
        .mentor-photo {
            width: 100%;
            height: auto;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php include 'components/header.php'; ?>

    <!-- Hero Section -->
    <section class="bg-orange text-white text-center py-5">
        <div class="container">
            <h1 class="display-4 fw-bold">Rencontrez Nos Mentors</h1>
            <p class="lead">Des experts dédiés à guider et soutenir les entrepreneurs dans leurs parcours.</p>
        </div>
    </section>

    <!-- Mentors Section -->
    <section class="container my-5">
        <h2 class="text-center text-orange mb-4">Nos Mentors</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <?php if (!empty($mentors)): ?>
                <?php foreach ($mentors as $mentor): ?>
                    <div class="col">
                        <div class="card mentor-card h-100 text-center border-0 shadow-sm">
                            <!-- Photo du mentor -->
                            <?php if (!empty($mentor['photo'])): ?>
                                <img src="./admin/uploads/mentors/<?php echo htmlspecialchars($mentor['photo']); ?>" 
                                     class="card-img-top mentor-photo mx-auto mt-3" 
                                     alt="<?php echo htmlspecialchars($mentor['name']); ?>">
                            <?php else: ?>
                                <img src="assets/images/default-mentor.png" 
                                     class="card-img-top mentor-photo mx-auto mt-3" 
                                     alt="Mentor par défaut">
                            <?php endif; ?>

                            <!-- Détails du mentor -->
                            <div class="card-body">
                                <h5 class="card-title text-orange fw-bold"><?php echo htmlspecialchars($mentor['name']); ?></h5>
                                <p class="text-muted mb-1"><?php echo htmlspecialchars($mentor['expertise']); ?></p>
                                <p class="card-text">
                                    <?php echo htmlspecialchars(substr($mentor['bio'], 0, 100)); ?>...
                                </p>
                                <?php if (!empty($mentor['linkedin'])): ?>
                                    <a href="<?php echo htmlspecialchars($mentor['linkedin']); ?>" 
                                       class="btn btn-outline-orange btn-sm" 
                                       target="_blank">
                                       <i class="fab fa-linkedin"></i> Voir sur LinkedIn
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">Aucun mentor disponible pour le moment.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-light py-5 text-center">
        <div class="container">
            <h2 class="text-orange fw-bold">Vous souhaitez devenir mentor ?</h2>
            <p class="lead">Partagez votre expertise avec la prochaine génération d'entrepreneurs.</p>
            <a href="contact.php" class="btn btn-orange text-white btn-lg" style="background-color: #FF6600;">Contactez-nous</a>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
