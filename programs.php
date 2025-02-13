<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programmes</title>
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
        .program-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .program-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
        }
        .program-icon {
            font-size: 3rem;
            color: #FF6600;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php include 'components/header.php'; ?>

    <!-- Hero Section -->
    <section class="bg-orange text-white text-center py-5">
        <div class="container">
            <h1 class="display-4 fw-bold">Nos Programmes</h1>
            <p class="lead">Découvrez les initiatives et services que nous offrons pour soutenir les startups et entrepreneurs.</p>
        </div>
    </section>

    <!-- Programs Section -->
    <section class="container my-5">
        <h2 class="text-center text-orange mb-4">Nos Initiatives</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <!-- Program 1 -->
            <div class="col">
                <div class="card program-card h-100 text-center border-0 shadow-sm">
                    <div class="card-body">
                        <div class="program-icon mb-3">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h5 class="card-title text-orange fw-bold">Programme d’Incubation</h5>
                        <p class="card-text">Accompagner les entrepreneurs dans les premières étapes de leur projet avec un soutien personnalisé.</p>
                    </div>
                </div>
            </div>
            <!-- Program 2 -->
            <div class="col">
                <div class="card program-card h-100 text-center border-0 shadow-sm">
                    <div class="card-body">
                        <div class="program-icon mb-3">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <h5 class="card-title text-orange fw-bold">Programme d’Accélération</h5>
                        <p class="card-text">Booster les startups prometteuses pour atteindre rapidement leur potentiel de croissance.</p>
                    </div>
                </div>
            </div>
            <!-- Program 3 -->
            <div class="col">
                <div class="card program-card h-100 text-center border-0 shadow-sm">
                    <div class="card-body">
                        <div class="program-icon mb-3">
                            <i class="fas fa-network-wired"></i>
                        </div>
                        <h5 class="card-title text-orange fw-bold">Mise en Réseau</h5>
                        <p class="card-text">Connecter les startups avec des investisseurs, partenaires et experts pour un développement réussi.</p>
                    </div>
                </div>
            </div>
            <!-- Program 4 -->
            <div class="col">
                <div class="card program-card h-100 text-center border-0 shadow-sm">
                    <div class="card-body">
                        <div class="program-icon mb-3">
                            <i class="fas fa-tools"></i>
                        </div>
                        <h5 class="card-title text-orange fw-bold">Espaces et Outils</h5>
                        <p class="card-text">Fournir des espaces de travail modernes et des outils innovants pour les startups.</p>
                    </div>
                </div>
            </div>
            <!-- Program 5 -->
            <div class="col">
                <div class="card program-card h-100 text-center border-0 shadow-sm">
                    <div class="card-body">
                        <div class="program-icon mb-3">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h5 class="card-title text-orange fw-bold">Formations Certifiées</h5>
                        <p class="card-text">Des formations de haut niveau pour développer les compétences en entrepreneuriat et gestion de projets.</p>
                    </div>
                </div>
            </div>
            <!-- Program 6 -->
            <div class="col">
                <div class="card program-card h-100 text-center border-0 shadow-sm">
                    <div class="card-body">
                        <div class="program-icon mb-3">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h5 class="card-title text-orange fw-bold">Innovation et Création</h5>
                        <p class="card-text">Encourager et promouvoir l'innovation à travers des ateliers et des événements.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-light py-5 text-center">
        <div class="container">
            <h2 class="text-orange fw-bold">Envie de rejoindre nos programmes ?</h2>
            <p class="lead">Postulez dès maintenant pour bénéficier de nos services et développer votre projet avec succès.</p>
            <a href="apply.php" class="btn btn-orange text-white btn-lg" style="background-color: #FF6600;">Postuler</a>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
