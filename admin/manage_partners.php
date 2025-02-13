<?php
session_start();

// Vérifier la session admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Charger la connexion PDO
require_once __DIR__ . '/config/database.php';

// === 1. Gérer l'insertion d'un nouveau partenaire ===
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create') {
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $website = trim($_POST['website'] ?? '');
    $status = trim($_POST['status'] ?? 'actif');

    // Par défaut, on ne stocke pas de chemin
    $logoPath = '';

    // Vérifier si un fichier a été uploadé
    if (!empty($_FILES['logo']['name'])) {
        // 1. Définir le répertoire de destination
        $uploadDir = __DIR__ . '/uploads/partners/';

        // 2. Générer un nom de fichier unique
        $uniqueName = uniqid('logo_', true);

        // 3. Extraire et nettoyer l’extension
        $extension = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
        $extension = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $extension));

        // 4. Construire le nom final
        $fileName = $uniqueName . '.' . $extension;
        $targetPath = $uploadDir . $fileName;

        // 5. Déplacer le fichier vers le répertoire de destination
        if (move_uploaded_file($_FILES['logo']['tmp_name'], $targetPath)) {
            $logoPath = $fileName;
        }
    }

    // Insert en base avec $logoPath si le fichier a été uploadé
    if (!empty($name)) {
        $sql = "INSERT INTO partners (nom, description, logo, site_web, status, created_at) 
                VALUES (:name, :description, :logo, :website, :status, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':logo', $logoPath);
        $stmt->bindValue(':website', $website);
        $stmt->bindValue(':status', $status);
        $stmt->execute();

        header('Location: manage_partners.php?success=1');
        exit;
    }
}

// === 2. Gérer la suspension d'un partenaire ===
if (isset($_GET['suspend'])) {
    $partnerId = (int) $_GET['suspend'];
    $sql = "UPDATE partners SET status = 'inactif' WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $partnerId, PDO::PARAM_INT);
    $stmt->execute();
    header('Location: manage_partners.php?success=2');
    exit;
}

// === 3. Gérer la suppression d'un partenaire ===
if (isset($_GET['delete'])) {
    $partnerId = (int) $_GET['delete'];
    $sql = "DELETE FROM partners WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $partnerId, PDO::PARAM_INT);
    $stmt->execute();
    header('Location: manage_partners.php?success=3');
    exit;
}

// === 4. Récupérer la liste des partenaires pour affichage ===
$sql = "SELECT * FROM partners ORDER BY id DESC";
$stmt = $pdo->query($sql);
$partners = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gérer les Partenaires</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="../assets/favicon-1.png" />
    <style>
        #main-content {
            margin-left: 240px;
            margin-top: 60px;
            padding: 1rem;
        }
    </style>
</head>

<body>
    <?php include 'components/navbar.php'; ?>
    <?php include 'components/sidebar.php'; ?>

    <div id="main-content">
        <h1 class="h3 mb-4">Gérer les Partenaires</h1>

        <?php if (isset($_GET['success'])): ?>
            <?php if ($_GET['success'] == 1): ?>
                <div class="alert alert-success">Partenaire ajouté avec succès !</div>
            <?php elseif ($_GET['success'] == 2): ?>
                <div class="alert alert-warning">Partenaire suspendu avec succès !</div>
            <?php elseif ($_GET['success'] == 3): ?>
                <div class="alert alert-danger">Partenaire supprimé avec succès !</div>
            <?php endif; ?>
        <?php endif; ?>

        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addPartnerModal">
            <i class="fas fa-plus"></i> Ajouter un Partenaire
        </button>

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
                    <?php if (!empty($partners)): ?>
                        <?php foreach ($partners as $partner): ?>
                            <tr>
                                <td><?php echo $partner['id']; ?></td>
                                <td><?php echo htmlspecialchars($partner['nom']); ?></td>
                                <td>
                                    <?php if (!empty($partner['logo'])): ?>
                                        <img src="./uploads/partners/<?php echo htmlspecialchars($partner['logo']); ?>" alt="Logo"
                                            style="max-height: 40px;">
                                    <?php else: ?>
                                        —
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!empty($partner['site_web'])): ?>
                                        <a href="<?php echo htmlspecialchars($partner['site_web']); ?>" target="_blank">Visiter</a>
                                    <?php else: ?>
                                        —
                                    <?php endif; ?>
                                </td>
                                <td><?php echo nl2br(htmlspecialchars($partner['description'])); ?></td>
                                <td>
                                    <span
                                        class="badge <?php echo $partner['status'] === 'actif' ? 'bg-success' : 'bg-secondary'; ?>">
                                        <?php echo ucfirst($partner['status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                    <a href="manage_partners.php?suspend=<?php echo $partner['id']; ?>"
                                        class="btn btn-sm btn-secondary"><i class="fa fa-ban"></i></a>
                                    <a href="manage_partners.php?delete=<?php echo $partner['id']; ?>"
                                        class="btn btn-sm btn-danger" onclick="return confirm('Confirmer la suppression ?');"><i
                                            class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">Aucun partenaire enregistré.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL d'ajout de Partenaire -->
    <div class="modal fade" id="addPartnerModal" tabindex="-1" aria-labelledby="addPartnerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPartnerModalLabel">Ajouter un Partenaire</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="manage_partners.php" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="create">

                        <!-- Nom du partenaire -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom du Partenaire</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                        </div>

                        <!-- Logo -->
                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo</label>
                            <input type="file" name="logo" id="logo" class="form-control" accept="image/*">
                        </div>

                        <!-- Site Web -->
                        <div class="mb-3">
                            <label for="website" class="form-label">Site Web</label>
                            <input type="url" name="website" id="website" class="form-control"
                                placeholder="https://www.example.com">
                        </div>

                        <!-- Statut -->
                        <div class="mb-3">
                            <label for="status" class="form-label">Statut</label>
                            <select name="status" id="status" class="form-select">
                                <option value="actif" selected>Actif</option>
                                <option value="inactif">Inactif</option>
                            </select>
                        </div>

                        <!-- Boutons -->
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>