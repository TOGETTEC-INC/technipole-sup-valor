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
                    <hr>
                    <h2> <b class="text-orange">Un centre d’accompagnement des jeunes</b> lieu de créativité et
                        d’animation des idées innovantes et à
                        forte valeur ajoutée à la création d’entreprise.</h2>
                    <hr>
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

    <!-- Section : Objectifs et Défis -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold text-orange mb-4" style="font-size: 2.5rem;">Nos Objectifs & Défis</h2>
        <p class="text-center lead mb-5" style="font-size: 1.2rem;">
            Engagés à promouvoir l'entrepreneuriat et à bâtir un avenir prometteur pour les jeunes talents.
        </p>
        <div class="row align-items-center">
            <!-- Colonne gauche : Objectifs -->
            <div class="col-md-6 mb-4 mb-md-0">
                <h3 class="fw-bold text-orange">Objectifs clés :</h3>
                <ul class="list-unstyled mt-4">
                    <li class="d-flex align-items-start mb-3">
                        <div class="text-orange me-3" style="font-size: 1.5rem;">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <p class="mb-0">
                            <strong>Sensibiliser 5000 jeunes</strong> à la création d’entreprises.
                        </p>
                    </li>
                    <li class="d-flex align-items-start mb-3">
                        <div class="text-orange me-3" style="font-size: 1.5rem;">
                            <i class="fas fa-building"></i>
                        </div>
                        <p class="mb-0">
                            <strong>Encadrer 100 entreprises</strong> viables et innovantes d’ici 2030.
                        </p>
                    </li>
                </ul>
            </div>
            <!-- Colonne droite : Défis -->
            <div class="col-md-6">
                <h3 class="fw-bold text-orange">Les Défis :</h3>
                <p class="mt-4 fs-5 text-muted">
                    Devenir un centre d’accompagnement de référence dans l’écosystème entrepreneurial camerounais.
                </p>
            </div>
        </div>
    </div>
</section>



    <!-- Section : Vision et Mission -->
    <section class="py-5 bg-orange text-white">
        <div class="container">
            <h2 class="text-center mb-5" style="font-weight: 700; font-size: 2.5rem;">Notre Vision & Mission</h2>
            <div class="row align-items-center">
                <!-- Vision -->
                <div class="col-md-6 mb-4 mb-md-0">
                    <div class="p-4 bg-white text-dark rounded shadow-sm">
                        <h3 class="fw-bold text-center text-orange">🌟 Vision</h3>
                        <p class="mt-3 fs-5 text-center">
                            Créer un écosystème entreneurial favorable à l'émergence des entreprises innovantes.
                        </p>
                    </div>
                </div>
                <!-- Mission -->
                <div class="col-md-6">
                    <div class="p-4 bg-white text-dark rounded shadow-sm">
                        <h3 class="fw-bold text-center text-orange">🎯 Mission</h3>
                        <p class="mt-3 fs-5">
                        <ul>
                            <li>Identifier des jeunes porteurs de projets innovants ou à fort potentiel de croissance.
                            </li>
                            <li>Sélectionner les projets et mettre à leur disposition des moyens logistiques, techniques
                                et financiers en association avec d’autres partenaires.</li>
                            <li>Susciter l’esprit d’entreprise auprès des jeunes et contribuer à l’émergence
                                d’entreprises performantes dans le milieu socioprofessionnel.</li>
                            <li>Accélérer la croissance des startups.</li>
                        </ul>


                        </p>
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


    <!-- Section : Valeurs -->
    <section class="py-5 bg-orange">
        <div class="container text-center">
            <h2 class="mb-4 fw-bold" style="font-size: 2.5rem; color:#f7f7f5">Nos Valeurs</h2>
            <p class="lead mb-5" style="font-size: 1.2rem;color:#f7f7f5">
                Les principes qui guident notre engagement envers l'innovation et l'excellence.
            </p>
            <div class="row g-4">
                <!-- Valeur 1 -->
                <div class="col-md-4">
                    <div class="p-4 bg-white rounded shadow-sm h-100">
                        <div class="text-orange" style="font-size: 3rem;">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h4 class="fw-bold mt-3">Discipline</h4>
                        <p class="mt-2 text-muted">Rigueur dans nos actions pour garantir l'excellence.</p>
                    </div>
                </div>
                <!-- Valeur 2 -->
                <div class="col-md-4">
                    <div class="p-4 bg-white rounded shadow-sm h-100">
                        <div class="text-orange" style="font-size: 3rem;">
                            <i class="fas fa-hard-hat"></i>
                        </div>
                        <h4 class="fw-bold mt-3">Travail</h4>
                        <p class="mt-2 text-muted">Le moteur de tout succès durable.</p>
                    </div>
                </div>
                <!-- Valeur 3 -->
                <div class="col-md-4">
                    <div class="p-4 bg-white rounded shadow-sm h-100">
                        <div class="text-orange" style="font-size: 3rem;">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h4 class="fw-bold mt-3">Engagement</h4>
                        <p class="mt-2 text-muted">Investir pleinement pour accompagner l’innovation.</p>
                    </div>
                </div>
                <!-- Valeur 4 -->
                <div class="col-md-4">
                    <div class="p-4 bg-white rounded shadow-sm h-100">
                        <div class="text-orange" style="font-size: 3rem;">
                            <i class="fas fa-balance-scale"></i>
                        </div>
                        <h4 class="fw-bold mt-3">Intégrité</h4>
                        <p class="mt-2 text-muted">Des valeurs solides et une éthique irréprochable.</p>
                    </div>
                </div>
                <!-- Valeur 5 -->
                <div class="col-md-4">
                    <div class="p-4 bg-white rounded shadow-sm h-100">
                        <div class="text-orange" style="font-size: 3rem;">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h4 class="fw-bold mt-3">Innovation</h4>
                        <p class="mt-2 text-muted">Imaginer et bâtir le futur avec créativité.</p>
                    </div>
                </div>
                <!-- Valeur 6 -->
                <div class="col-md-4">
                    <div class="p-4 bg-white rounded shadow-sm h-100">
                        <div class="text-orange" style="font-size: 3rem;">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <h4 class="fw-bold mt-3">Succès</h4>
                        <p class="mt-2 text-muted">Créer les conditions pour atteindre l’excellence.</p>
                    </div>
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

    <section class="my-5 py-3">
        <div class="container">
            <h2 class="text-orange mb-4">Actualités</h2>
            <div id="newsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php if (!empty($newsList)): ?>
                        <?php foreach ($newsList as $index => $news): ?>
                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                <div class="row align-items-center">

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

                                    <!-- Titre et contenu -->
                                    <div class="col-md-6">
                                        <h3 class="fw-bold" style="font-size: calc(1rem + 1vw);">
                                            <?php echo htmlspecialchars($news['title']); ?>
                                        </h3>
                                        <p style="font-size: calc(0.8rem + 0.5vw);">
                                            <?php echo nl2br(substr(htmlspecialchars_decode($news['content'], ENT_QUOTES), 0, 500)); ?>...
                                        </p>
                                        <a href="news_details.php?id=<?php echo $news['id']; ?>" class="btn btn-orange">
                                            Lire plus
                                        </a>
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
    <!-- <section class="container my-5">
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
    </section> -->

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
                                            style="max-height: 100px;">
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


    <?php
    // Récupérer les partenaires actifs depuis la base de données
    $sql = "SELECT nom, logo, site_web FROM partners WHERE status = 'actif' ORDER BY id DESC";
    $stmt = $pdo->query($sql);
    $partners = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <!-- Section : Partenaires & Sponsors -->
    <section class="container my-5">
        <h2 class="text-center text-orange mb-4">Partenaires & Sponsors</h2>
        <div class="row justify-content-center">
            <?php if (!empty($partners)): ?>
                <?php foreach ($partners as $partner): ?>
                    <div class="col-md-2 col-6 text-center mb-4">
                        <?php if (!empty($partner['site_web'])): ?>
                            <!-- Lien vers le site du partenaire -->
                            <a href="<?php echo htmlspecialchars($partner['site_web']); ?>" target="_blank"
                                rel="noopener noreferrer">
                                <img src="./admin/uploads/partners/<?php echo htmlspecialchars($partner['logo']); ?>"
                                    alt="<?php echo htmlspecialchars($partner['nom']); ?>" class="img-fluid mb-2">
                            </a>
                        <?php else: ?>
                            <!-- Si pas de lien, afficher uniquement le logo -->
                            <img src="./admin/uploads/partners/<?php echo htmlspecialchars($partner['logo']); ?>"
                                alt="<?php echo htmlspecialchars($partner['nom']); ?>" class="img-fluid mb-2">
                        <?php endif; ?>

                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">Aucun partenaire disponible pour le moment.</p>
            <?php endif; ?>
        </div>
    </section>


    <!-- Nouveau Footer au style Y Combinator -->
    <?php include 'components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>