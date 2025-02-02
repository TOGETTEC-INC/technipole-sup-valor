<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technipole Sup Valor</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="./assets/favicon-1.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />



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

        /* On peut ajuster la couleur de fond si on veut un effet légèrement crème */
        .bg-cream {
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

    <?php
    // Récupérer le nombre total de startups
    require_once './admin/config/database.php';

    $sql = "SELECT COUNT(*) AS total_startups FROM startups";
    $stmt = $pdo->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $totalStartups = $result['total_startups'] ?? 0;
    ?>


    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <!-- Colonne gauche : Texte -->
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h1 class="display-4 fw-bold text-orange">Nous investissons dans les startups du futur</h1>
                    <p class="lead">Le Technipole Sup Valor aide les startups innovantes à grandir et réussir grâce à un
                        réseau d’experts et un programme structuré.</p>
                    <a href="apply.html" class="btn btn-orange btn-lg text-white"
                        style="background-color: #FF6600; border: none;">Rejoignez-nous</a>
                </div>
                <!-- Colonne droite : Image/Stats -->
                <div class="col-lg-6 text-center">
                    <!-- Image ou cards de stats -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3 bg-light shadow-sm rounded">
                                <h4 class="text-orange"><?php echo htmlspecialchars($totalStartups); ?>+</h4>
                                <p class="mb-0">Startups incubées</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 bg-light shadow-sm rounded">
                                <h4 class="text-orange">0 XAF</h4>
                                <p class="mb-0">Levés au total</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light shadow-sm rounded">
                                <h4 class="text-orange">60%</h4>
                                <p class="mb-0">Taux de réussite</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light shadow-sm rounded">
                                <h4 class="text-orange">Global</h4>
                                <p class="mb-0">Présence Nationale</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section : Mot de la Coordonnatrice -->
    <section class="my-5">
        <div class="container">
            <h2 class="text-orange mb-4">Le Mot de la Coordonnatrice</h2>
            <div class="row align-items-center">
                <div class="col-md-3">
                    <img src="./admin/uploads/users/coordo.png" class="img-fluid rounded shadow-sm"
                        alt="Coordonnatrice">
                </div>
                <div class="col-md-9 mt-3 mt-md-0">
                    <p class="fs-5">Bienvenue au Technipole Sup Valor. Notre mission est de soutenir les entrepreneurs
                        de demain et de bâtir ensemble un écosystème d’innovation solide. Nous nous engageons à
                        accompagner nos porteurs de projet avec passion, expertise et bienveillance. L’avenir est entre
                        vos mains, et nous sommes là pour vous aider à le façonner.</p>
                    <p class="text-muted">— <strong>M.L. BISSENE MOULONGO</strong>, Coordonnatrice du Technipole Sup
                        Valor</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Actualités (Slider) -->
    <?php
    // Récupérer les actualités publiées
    $sql = "SELECT id, title, content, image, created_at FROM news WHERE status = 'published' ORDER BY created_at DESC";
    $stmt = $pdo->query($sql);
    $newsList = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <section class="my-5 bg-cream py-3">
        <div class="container">
            <h2 class="text-orange mb-4">Actualités</h2>
            <div id="newsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php if (!empty($newsList)): ?>
                        <?php foreach ($newsList as $index => $news): ?>
                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                <div class="row align-items-center">
                                    

                                    <!-- Titre et contenu -->
                                    <div class="col-md-6">
                                        <h3 class="fw-bold" style="font-size: calc(1rem + 1vw);">
                                            <?php echo htmlspecialchars($news['title']); ?>
                                        </h3>
                                        <p style="font-size: calc(0.8rem + 0.5vw);">
                                            <?php echo nl2br(htmlspecialchars(substr($news['content'], 0, 200))); ?>...
                                        </p>
                                        <a href="news_details.php?id=<?php echo $news['id']; ?>" class="btn btn-orange">
                                            Lire plus
                                        </a>
                                    </div>

                                    <!-- Image -->
                                    <div class="col-md-6">
                                        <?php if (!empty($news['image'])): ?>
                                            <img src="./admin/<?php echo htmlspecialchars($news['image']); ?>"
                                                class="d-block w-100 img-fluid rounded"
                                                alt="<?php echo htmlspecialchars($news['title']); ?>">
                                        <?php else: ?>
                                            <img src="assets/images/placeholder.jpg" class="d-block w-100 img-fluid rounded"
                                                alt="Image non disponible">
                                        <?php endif; ?>
                                    </div>
                                    
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-center">Aucune actualité disponible pour le moment.</p>
                    <?php endif; ?>
                </div>

                <!-- Contrôles du carousel -->
                <button class="carousel-control-prev" type="button" data-bs-target="#newsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Précédent</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#newsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Suivant</span>
                </button>
            </div>
        </div>
    </section>



    <!-- Sections: Programme / Startups / Événements -->
    <section class="container my-5">
        <div class="row text-center">
            <div class="col-md-4">
                <h3 class="text-orange">Programme</h3>
                <p>Découvrez comment nous aidons les startups à réussir.</p>
                <a href="programs.html" class="text-orange">En savoir plus →</a>
            </div>
            <div class="col-md-4">
                <h3 class="text-orange">Startups</h3>
                <p>Les startups qui ont bénéficié de notre accompagnement.</p>
                <a href="startups.html" class="text-orange">Voir les startups →</a>
            </div>
            <div class="col-md-4">
                <h3 class="text-orange">Événements</h3>
                <p>Participez à nos événements et conférences.</p>
                <a href="events.html" class="text-orange">Explorer les événements →</a>
            </div>
        </div>
    </section>

    <?php
    // Récupération des startups
    require_once './admin/config/database.php';

    $sql = "SELECT id, name, logo FROM startups ORDER BY id DESC";
    $stmt = $pdo->query($sql);
    $startups = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <!-- Startup Logos Section (Nouveau format inspiré YC) -->
    <section class="py-5 bg-cream">
        <div class="container">
            <h2 class="mb-4 fw-bold" style="font-size: 1.5rem;">
                Technipole Startups / Entreprises
            </h2>

            <!-- Grid responsive Bootstrap : 2 à 5 colonnes -->
            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-3">

                <?php if (!empty($startups)): ?>
                    <?php foreach ($startups as $startup): ?>
                        <div class="col text-center">
                            <div class="bg-white shadow-sm p-3 h-100 d-flex align-items-center justify-content-center">
                                <a href="startup_detail.php?id=<?php echo $startup['id']; ?>">
                                    <?php if (!empty($startup['logo'])): ?>
                                        <img src="./admin/uploads/startups/<?php echo htmlspecialchars($startup['logo']); ?>"
                                            alt="<?php echo htmlspecialchars($startup['name']); ?>" class="img-fluid"
                                            style="max-height: 40px;">
                                    <?php else: ?>
                                        <!-- Logo non disponible : icône ou placeholder -->
                                        <i class="fa fa-image fa-2x text-muted"></i>
                                    <?php endif; ?>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Aucune startup disponible pour le moment.</p>
                <?php endif; ?>

            </div><!-- Fin .row -->
        </div><!-- Fin .container -->
    </section>



    <!-- Section : Partenaires & Sponsors -->
    <section class="container my-5">
        <h2 class="text-center text-orange mb-4">Partenaires & Sponsors</h2>
        <div class="row justify-content-center">
            <!-- Exemple de partenaire/sponsor 1 -->
            <div class="col-md-2 col-6 text-center mb-4">
                <img src="assets/images/partner1_logo.png" alt="Partner 1 Logo" class="img-fluid mb-2">
                <h6>Partner 1</h6>
            </div>
            <!-- Exemple de partenaire/sponsor 2 -->
            <div class="col-md-2 col-6 text-center mb-4">
                <img src="assets/images/partner2_logo.png" alt="Partner 2 Logo" class="img-fluid mb-2">
                <h6>Partner 2</h6>
            </div>
            <!-- Exemple de partenaire/sponsor 3 -->
            <div class="col-md-2 col-6 text-center mb-4">
                <img src="assets/images/partner3_logo.png" alt="Partner 3 Logo" class="img-fluid mb-2">
                <h6>Partner 3</h6>
            </div>
            <!-- Ajoutez autant de colonnes que nécessaire -->
        </div>
    </section>

    <!-- Nouveau Footer au style Y Combinator -->
    <?php include 'components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>