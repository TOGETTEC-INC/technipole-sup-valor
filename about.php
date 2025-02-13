<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À Propos</title>
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
        .section-title {
            font-size: 2rem;
            font-weight: bold;
        }
        .list-check {
            list-style: none;
            padding-left: 0;
        }
        .list-check li::before {
            content: "✔";
            color: #FF6600;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php include 'components/header.php'; ?>

    <!-- Hero Section -->
    <section class="bg-orange text-white text-center py-5">
        <div class="container">
            <h1 class="display-4 fw-bold">À Propos du Technipole Sup-Valor</h1>
            <p class="lead">Un lieu d'innovation, d'accompagnement et d'excellence pour les entrepreneurs.</p>
        </div>
    </section>

    <!-- Contenu Principal -->
    <section class="container my-5">
        <!-- Les Services -->
        <div class="mb-5">
            <h2 class="section-title text-orange">Les Services</h2>
            <ul class="list-check mt-3">
                <li>ACCUEIL, Orientation et Conseil</li>
                <li>Formation</li>
                <li>Information</li>
                <li>Mise à disposition des espaces de travail et des outils de gestion</li>
                <li>Mise en réseau dynamique des Startups</li>
            </ul>
        </div>

        <!-- Les Activités -->
        <div class="mb-5">
            <h2 class="section-title text-orange">Les Activités</h2>
            <ul class="list-check mt-3">
                <li>Séminaire et ateliers</li>
                <li>Journées portes ouvertes</li>
                <li>Promotion des nouveaux produits numériques</li>
                <li>Formations certifiées en gestion des projets, entrepreneuriat et bien d’autres</li>
            </ul>
        </div>

        <!-- La Durée de l'Incubation -->
        <div class="mb-5">
            <h2 class="section-title text-orange">La Durée de l’Incubation</h2>
            <p class="mt-3">
                La durée de l’hébergement est de <strong>24 mois</strong>, dont <strong>06 mois en incubation maximum</strong> en pépinière. 
                Sauf cas exceptionnel qui exigerait un prolongement du séjour ou un départ avant terme.
            </p>
        </div>

        <!-- Les Domaines d'Incubation -->
        <div class="mb-5">
            <h2 class="section-title text-orange">Les Domaines d’Incubation</h2>
            <ul class="list-check mt-3">
                <li>TIC / Services</li>
                <li>Industries</li>
                <li>Élevage</li>
                <li>Agriculture</li>
            </ul>
        </div>

        <!-- Processus d'Incubation -->
        <div class="mb-5">
            <h2 class="section-title text-orange">Processus d’Incubation</h2>
            <ol class="list-check mt-3">
                <li>Présélection des candidats</li>
                <li>Test de profil entrepreneurial</li>
                <li>Sélection des candidats à l’incubation</li>
                <li>Signature du contrat d’incubation</li>
                <li>Formation à l’esprit d’entreprise / activités collectives et animations</li>
                <li>Prise en charge par les experts</li>
                <li>Élaboration des plans d’affaires</li>
                <li>Mise en place des financements</li>
                <li>Formalités de création d’entreprise</li>
                <li>Hébergement / suivi / accompagnement</li>
                <li>Évaluation de l’incubation</li>
                <li>Sortie de l’incubation et insertion dans le milieu socio-professionnel</li>
            </ol>
        </div>

        <!-- Comment Bénéficier de l’Accompagnement -->
        <div class="mb-5">
            <h2 class="section-title text-orange">Comment Bénéficier de l’Accompagnement ?</h2>
            <ul class="list-check mt-3">
                <li>Être porteur d’une idée ou avoir démarré une activité</li>
                <li>Se présenter au Technipole Sup-Valor</li>
                <li>Remplir la fiche de sélection</li>
                <li>Passer les tests du profil entrepreneur</li>
                <li>Les informations complémentaires seront données sur place</li>
            </ul>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
