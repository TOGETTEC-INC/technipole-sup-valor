<?php
    session_start();

    // Vérifier la session admin
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: login.php');
        exit;
    }

    // Charger la connexion PDO
    require_once './config/database.php';

    // Vérifier si un ID de candidature est passé en paramètre
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        die("ID de candidature non valide.");
    }

    $applicationId = intval($_GET['id']);

    // Récupérer les détails de la candidature
    $sql = "SELECT * FROM applications WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $applicationId, PDO::PARAM_INT);
    $stmt->execute();
    $application = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si la candidature n'existe pas
    if (!$application) {
        die("Candidature introuvable.");
    }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Voir Candidature - <?php echo htmlspecialchars($application['project_name']); ?></title>
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
    <div id="main-content" class="container my-5">
        <h1 class="mb-4">Détails de la Candidature</h1>

        <!-- Détails de la candidature -->
        <div class="card">
            <div class="card-header">
                <h2 class="h5 mb-0"><?php echo htmlspecialchars($application['project_name']); ?></h2>
            </div>
            <div class="card-body">
                <p><strong>Nom complet :</strong> <?php echo htmlspecialchars($application['full_name']); ?></p>
                <p><strong>Email :</strong> <a href="mailto:<?php echo htmlspecialchars($application['email']); ?>"><?php echo htmlspecialchars($application['email']); ?></a></p>
                <p><strong>Téléphone :</strong> <?php echo htmlspecialchars($application['phone']); ?></p>
                <p><strong>Secteur d'activité :</strong> <?php echo htmlspecialchars($application['sector']); ?></p>
                <p><strong>Description :</strong></p>
                <p><?php echo nl2br(htmlspecialchars_decode($application['description'], ENT_QUOTES)); ?></p>
                <p><strong>Date de soumission :</strong> <?php echo date('d/m/Y H:i', strtotime($application['created_at'])); ?></p>
                <p><strong>Statut :</strong> 
                    <span class="badge 
                        <?php echo $application['status'] === 'accepted' ? 'bg-success' : ($application['status'] === 'rejected' ? 'bg-danger' : 'bg-secondary'); ?>">
                        <?php echo htmlspecialchars(ucfirst($application['status'])); ?>
                    </span>
                </p>
                <?php if (!empty($application['document_path'])): ?>
                    <p><strong>Document :</strong> <a href="<?php echo htmlspecialchars($application['document_path']); ?>" target="_blank">Télécharger</a></p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Bouton retour -->
        <div class="mt-4">
            <a href="admin.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour</a>
        </div>
    </div>
    <!-- fin #main-content -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
