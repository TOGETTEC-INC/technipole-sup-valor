<?php
// Charger la connexion PDO
require_once './admin/config/database.php';

// Récupérer les événements depuis la base de données
$sql = "SELECT id, title, description, date, location, image FROM events ORDER BY date DESC";
$stmt = $pdo->query($sql);
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Événements</title>
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
        .event-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
        }
        .event-image {
            max-height: 200px;
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
            <h1 class="display-4 fw-bold">Nos Événements</h1>
            <p class="lead">Découvrez et participez à nos événements pour renforcer vos compétences et élargir votre réseau.</p>
        </div>
    </section>

    <!-- Events Section -->
    <section class="container my-5">
        <h2 class="text-center text-orange mb-4">Prochains Événements</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            <?php if (!empty($events)): ?>
                <?php foreach ($events as $event): ?>
                    <div class="col">
                        <div class="card event-card h-100">
                            <!-- Image de l'événement -->
                            <?php if (!empty($event['image'])): ?>
                                <img src="./admin/uploads/events/<?php echo htmlspecialchars($event['image']); ?>" 
                                     class="card-img-top event-image" 
                                     alt="<?php echo htmlspecialchars($event['title']); ?>">
                            <?php else: ?>
                                <img src="assets/images/placeholder.jpg" 
                                     class="card-img-top event-image" 
                                     alt="Image non disponible">
                            <?php endif; ?>

                            <!-- Contenu de la carte -->
                            <div class="card-body">
                                <h5 class="card-title text-orange"><?php echo htmlspecialchars($event['title']); ?></h5>
                                <p class="card-text text-muted">
                                    <?php echo htmlspecialchars(substr($event['description'], 0, 100)) . '...'; ?>
                                </p>
                                <p class="text-muted mb-1">
                                    <i class="fas fa-calendar-alt"></i> <?php echo date('d M Y', strtotime($event['date'])); ?>
                                </p>
                                <p class="text-muted">
                                    <i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($event['location']); ?>
                                </p>
                                <a href="event_details.php?id=<?php echo $event['id']; ?>" 
                                   class="btn btn-outline-orange btn-sm">
                                    En savoir plus
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">Aucun événement prévu pour le moment.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-light py-5 text-center">
        <div class="container">
            <h2 class="text-orange fw-bold">Vous souhaitez participer ?</h2>
            <p class="lead">Rejoignez nos événements et faites partie de l'écosystème innovant du Technipole Sup-Valor.</p>
            <a href="contact.php" class="btn btn-orange text-white btn-lg" style="background-color: #FF6600;">Contactez-nous</a>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
