<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - Administration</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Font Awesome (icônes) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="../assets/favicon-1.png" />

</head>

<body>
    <!-- NAVBAR -->
    <?php include 'components/navbar.php'; ?>

    <!-- SIDEBAR -->
    <?php include 'components/sidebar.php'; ?>

    <!-- MAIN CONTENT -->
    <div id="main-content">
        <h1 class="h3 mb-4">Tableau de bord</h1>

        <!-- sections / widgets -->

        <?php
        // Récupérer le nombre total de startups
        require_once './config/database.php';

        $sql = "SELECT COUNT(*) AS total_startups FROM startups";
        $stmt = $pdo->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalStartups = $result['total_startups'] ?? 0;
        ?>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card bg-primary text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Startups Actives</h5>
                        <p class="card-text fs-4"><?php echo htmlspecialchars($totalStartups); ?></p> 
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Événements à venir</h5>
                        <p class="card-text fs-4">3</p> <!-- Valeur simulée -->
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-warning text-dark mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Nouveaux Messages</h5>
                        <p class="card-text fs-4">7</p> <!-- Valeur simulée -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Exemple : Liste rapide de candidatures récentes -->
        <div class="card mb-4">
            <div class="card-header">
                Dernières Candidatures
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Startup</th>
                            <th scope="col">Date de soumission</th>
                            <th scope="col">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Données d'exemple -->
                        <tr>
                            <td>Startup Alpha</td>
                            <td>2025-01-10</td>
                            <td><span class="badge bg-success">Acceptée</span></td>
                        </tr>
                        <tr>
                            <td>Startup Beta</td>
                            <td>2025-01-12</td>
                            <td><span class="badge bg-secondary">En cours</span></td>
                        </tr>
                        <tr>
                            <td>Startup Gamma</td>
                            <td>2025-01-15</td>
                            <td><span class="badge bg-danger">Refusée</span></td>
                        </tr>
                    </tbody>
                </table>
                <!-- Un lien pour voir plus de candidatures -->
                <a href="manage_startups.php" class="btn btn-sm btn-primary">Voir tout</a>
            </div>
        </div>

        <!-- Ajoutez d'autres modules, graphiques, etc. -->

    </div> <!-- fin #main-content -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>