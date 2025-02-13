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

        <?php
        // Charger la connexion PDO
        require_once './config/database.php';

        // Vérifier si une mise à jour de statut est demandée
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
            $applicationId = intval($_POST['application_id']);
            $newStatus = trim($_POST['status']);

            // Mettre à jour le statut dans la base de données
            $sql = "UPDATE applications SET status = :status WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':status', $newStatus, PDO::PARAM_STR);
            $stmt->bindValue(':id', $applicationId, PDO::PARAM_INT);
            $stmt->execute();
        }

        // Récupérer les candidatures
        $sql = "SELECT id, project_name, created_at, status FROM applications ORDER BY created_at DESC LIMIT 10";
        $stmt = $pdo->query($sql);
        $applications = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

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
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($applications)): ?>
                            <?php foreach ($applications as $application): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($application['project_name']); ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($application['created_at'])); ?></td>
                                    <td>
                                        <form method="POST" action="">
                                            <input type="hidden" name="application_id"
                                                value="<?php echo $application['id']; ?>">
                                            <select name="status" class="form-select form-select-sm"
                                                onchange="this.form.submit()">
                                                <option value="pending" <?php echo $application['status'] === 'pending' ? 'selected' : ''; ?>>En demande</option>
                                                <option value="accepted" <?php echo $application['status'] === 'accepted' ? 'selected' : ''; ?>>Acceptée</option>
                                                <option value="rejected" <?php echo $application['status'] === 'rejected' ? 'selected' : ''; ?>>Annulée</option>
                                            </select>
                                            <input type="hidden" name="update_status" value="1">
                                        </form>
                                    </td>
                                    <td>
                                        <a href="view_application.php?id=<?php echo $application['id']; ?>"
                                            class="btn btn-sm btn-info">Voir</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">Aucune candidature disponible.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <!-- Un lien pour voir plus de candidatures -->
                <a href="manage_startups.php" class="btn btn-sm btn-primary">Voir tout</a>
            </div>
        </div>



    </div> <!-- fin #main-content -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>