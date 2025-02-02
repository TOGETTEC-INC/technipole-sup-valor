<?php
session_start();

// Vérifier la session admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Charger la connexion PDO
require_once __DIR__ . '/config/database.php';

// === 1. Gérer l'insertion d'une nouvelle startup ===
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create') {
    $name        = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $website     = trim($_POST['website'] ?? '');

    // Par défaut, on ne stocke pas de chemin
    $logoPath = '';

    // Vérifier si un fichier a été uploadé
    if (!empty($_FILES['logo']['name'])) {
        // 1. Définir le répertoire de destination (par ex. public/uploads/)
        $uploadDir = __DIR__ . '/uploads/startups/';

        // 2. Générer un nom de fichier unique (pour éviter les collisions)
        $uniqueName = uniqid('logo_', true);

        // 3. Extraire l’extension du fichier
        $extension = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);

        // 4. Nettoyer l’extension pour plus de sécurité
        $extension = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $extension));

        // 5. Combiner pour former le nom final
        $fileName = $uniqueName . '.' . $extension;

        // 6. Construire le chemin complet sur le serveur
        $targetPath = $uploadDir . $fileName;

        // Vous pouvez vérifier la taille du fichier, le type MIME, etc.
        // Par exemple, vérifier si c'est bien une image :
        // $allowedTypes = ['image/jpeg','image/png','image/gif'];
        // if (!in_array($_FILES['logo']['type'], $allowedTypes)) { ... }

        // 7. Déplacer le fichier depuis le répertoire temporaire
        if (move_uploaded_file($_FILES['logo']['tmp_name'], $targetPath)) {
            // 8. Conserver le chemin relatif (pour l'affichage dans <img>)
            // Si votre URL publique est par exemple : http://votresite/uploads/...
            // alors vous pouvez stocker 'uploads/<nomFichier>' dans la BD

            $logoPath = $fileName;
        }
    }

    // Insert en base avec $logoPath si le fichier a été uploadé
    if (!empty($name)) {
        $sql = "INSERT INTO startups (name, description, logo, website) 
                VALUES (:name, :description, :logo, :website)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':logo', $logoPath);
        $stmt->bindValue(':website', $website);
        $stmt->execute();

        header('Location: manage_startups.php?success=1');
        exit;
    }
}


// === 2. Gérer la suspension d'une startup ===
if (isset($_GET['suspend'])) {
    $startupId = (int) $_GET['suspend'];
    // On passe le statut à 'suspended'
    $sql = "UPDATE startups SET status = 'suspended' WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $startupId, PDO::PARAM_INT);
    $stmt->execute();
    header('Location: manage_startups.php?success=2');
    exit;
}

// === 3. Gérer la suppression d'une startup ===
if (isset($_GET['delete'])) {
    $startupId = (int) $_GET['delete'];
    $sql = "DELETE FROM startups WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $startupId, PDO::PARAM_INT);
    $stmt->execute();
    header('Location: manage_startups.php?success=3');
    exit;
}

// === 4. Récupérer la liste des startups pour affichage ===
$sql = "SELECT * FROM startups ORDER BY id DESC";
$stmt = $pdo->query($sql);
$startups = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gérer les Startups</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Font Awesome (icônes) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="../assets/favicon-1.png" />

    <style>
        /* Ajuster au besoin selon votre layout existant */
        #main-content {
            margin-left: 240px;
            /* Si votre sidebar fait 240px */
            margin-top: 60px;
            /* Si votre navbar fait 60px de haut */
            padding: 1rem;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <?php include 'components/navbar.php'; ?>

    <!-- SIDEBAR -->
    <?php include 'components/sidebar.php'; ?>

    <!-- MAIN CONTENT -->
    <div id="main-content">
        <h1 class="h3 mb-4">Gérer les Startups</h1>

        <!-- Messages de succès éventuels -->
        <?php if (isset($_GET['success'])): ?>
            <?php if ($_GET['success'] == 1): ?>
                <div class="alert alert-success">Startup ajoutée avec succès !</div>
            <?php elseif ($_GET['success'] == 2): ?>
                <div class="alert alert-warning">Startup suspendue avec succès !</div>
            <?php elseif ($_GET['success'] == 3): ?>
                <div class="alert alert-success">Startup supprimée avec succès !</div>
            <?php endif; ?>
        <?php endif; ?>

        <!-- Bouton pour ouvrir le modal d'ajout -->
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addStartupModal">
            <i class="fas fa-plus"></i> Ajouter une Startup
        </button>

        <!-- Tableau des startups -->
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Logo</th>
                        <th>Site Web</th>
                        <th>Description</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($startups)): ?>
                        <?php foreach ($startups as $startup): ?>
                            <tr>
                                <td><?php echo $startup['id']; ?></td>
                                <td><?php echo htmlspecialchars($startup['name']); ?></td>
                                <td>
                                    <?php if (!empty($startup['logo'])): ?>
                                        <img src="./uploads/startups/<?php echo htmlspecialchars($startup['logo']); ?>" alt="Logo"
                                            style="max-height: 40px;">
                                    <?php else: ?>
                                        —
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!empty($startup['website'])): ?>
                                        <a href="<?php echo htmlspecialchars($startup['website']); ?>" target="_blank"
                                            rel="noopener noreferrer">Visiter</a>
                                    <?php else: ?>
                                        —
                                    <?php endif; ?>
                                </td>
                                <td><?php echo nl2br(htmlspecialchars($startup['description'])); ?></td>
                                <td>
                                    <?php if ($startup['status'] === 'suspended'): ?>
                                        <span class="badge bg-secondary">Suspendue</span>
                                    <?php else: ?>
                                        <span class="badge bg-success">Active</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <!-- Bouton Modifier (à implémenter) -->
                                    <a href="#" class="btn btn-sm btn-warning"
                                        onclick="alert('Fonctionnalité Modifier à implémenter'); return false;">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <!-- Bouton Suspendre -->
                                    <?php if ($startup['status'] !== 'suspended'): ?>
                                        <a href="manage_startups.php?suspend=<?php echo $startup['id']; ?>"
                                            class="btn btn-sm btn-secondary"
                                            onclick="return confirm('Voulez-vous vraiment suspendre cette startup ?');">
                                            <i class="fa fa-ban"></i>
                                        </a>
                                    <?php endif; ?>

                                    <!-- Bouton Supprimer -->
                                    <a href="manage_startups.php?delete=<?php echo $startup['id']; ?>"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Voulez-vous vraiment supprimer cette startup ?');">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">Aucune startup enregistrée.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div> <!-- fin .table-responsive -->

    </div> <!-- fin #main-content -->

    <!-- MODAL d'ajout de Startup -->
    <div class="modal fade" id="addStartupModal" tabindex="-1" aria-labelledby="addStartupModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStartupModalLabel">Ajouter une Startup</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="manage_startups.php" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="create">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom de la Startup</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo</label>
                            <input type="file" name="logo" id="logo" class="form-control" accept="image/*">
                        </div>

                        <div class="mb-3">
                            <label for="website" class="form-label">Site Web</label>
                            <input type="url" name="website" id="website" class="form-control" value="https://www.">
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary me-2"
                                data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin du modal -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>