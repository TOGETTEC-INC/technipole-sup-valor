<?php

// Charger la connexion PDO
require_once 'config/database.php';

// Ajouter une actualité
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $author = trim($_POST['author'] ?? 'Admin');
    $status = trim($_POST['status'] ?? 'draft');
    $imagePath = '';

    // Gestion de l'image uploadée
    if (!empty($_FILES['image']['name'])) {
        $uploadDir = __DIR__ . '/uploads/news/';
        $uniqueName = uniqid('news_', true);
        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $fileName = $uniqueName . '.' . strtolower($extension);
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $imagePath = '/uploads/news/' . $fileName;
        }
    }

    // Insérer dans la base de données
    if (!empty($title) && !empty($content)) {
        $sql = "INSERT INTO news (title, content, image, author, status) 
                VALUES (:title, :content, :image, :author, :status)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':content', $content);
        $stmt->bindValue(':image', $imagePath);
        $stmt->bindValue(':author', $author);
        $stmt->bindValue(':status', $status);
        $stmt->execute();
        header('Location: manage_news.php?success=1');
        exit;
    }
}

// Modifier une actualité
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $id = (int) $_POST['id'];
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $author = trim($_POST['author'] ?? 'Admin');
    $status = trim($_POST['status'] ?? 'draft');
    $imagePath = $_POST['current_image'] ?? '';

    // Gestion de l'image uploadée
    if (!empty($_FILES['image']['name'])) {
        $uploadDir = __DIR__ . '/uploads/news/';
        $uniqueName = uniqid('news_', true);
        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $fileName = $uniqueName . '.' . strtolower($extension);
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $imagePath = '/uploads/news/' . $fileName;
        }
    }

    // Mise à jour dans la base de données
    $sql = "UPDATE news SET title = :title, content = :content, image = :image, author = :author, status = :status 
            WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':title', $title);
    $stmt->bindValue(':content', $content);
    $stmt->bindValue(':image', $imagePath);
    $stmt->bindValue(':author', $author);
    $stmt->bindValue(':status', $status);
    $stmt->execute();
    header('Location: manage_news.php?success=2');
    exit;
}

// Supprimer une actualité
if (isset($_GET['delete'])) {
    $newsId = (int) $_GET['delete'];
    $sql = "DELETE FROM news WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $newsId, PDO::PARAM_INT);
    $stmt->execute();
    header('Location: manage_news.php?success=3');
    exit;
}

// Récupérer les actualités
$sql = "SELECT * FROM news ORDER BY created_at DESC";
$stmt = $pdo->query($sql);
$newsList = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gérer les Actualités</title>
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
        <h1 class="h3 mb-4">Gérer les Actualités</h1>

        <!-- Messages de succès -->
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">
                <?php
                echo ($_GET['success'] == 1) ? 'Actualité ajoutée avec succès !' :
                    (($_GET['success'] == 2) ? 'Actualité modifiée avec succès !' : 'Actualité supprimée avec succès !');
                ?>
            </div>
        <?php endif; ?>

        <!-- Bouton pour ouvrir le modal d'ajout -->
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addNewsModal">
            <i class="fas fa-plus"></i> Ajouter une Actualité
        </button>

        <!-- Tableau des actualités -->
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Image</th>
                        <th>Auteur</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($newsList)): ?>
                        <?php foreach ($newsList as $news): ?>
                            <tr>
                                <td><?php echo $news['id']; ?></td>
                                <td><?php echo htmlspecialchars($news['title']); ?></td>
                                <td>
                                    <?php if (!empty($news['image'])): ?>
                                        <img src=".<?php echo htmlspecialchars($news['image']); ?>" alt="Image Actualité"
                                            style="max-height: 50px;">
                                    <?php else: ?>
                                        <span class="text-muted">Pas d'image</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($news['author']); ?></td>
                                <td>
                                    <?php if ($news['status'] === 'published'): ?>
                                        <span class="badge bg-success">Publié</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Brouillon</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <!-- Modifier -->
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editNewsModal-<?php echo $news['id']; ?>">
                                        <i class="fa fa-edit"></i>
                                    </button>

                                    <!-- Supprimer -->
                                    <a href="manage_news.php?delete=<?php echo $news['id']; ?>" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Voulez-vous vraiment supprimer cette actualité ?');">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Modal pour modifier une actualité -->
                            <div class="modal fade" id="editNewsModal-<?php echo $news['id']; ?>" tabindex="-1"
                                aria-labelledby="editNewsModalLabel-<?php echo $news['id']; ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editNewsModalLabel-<?php echo $news['id']; ?>">Modifier
                                                l'Actualité</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Fermer"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="manage_news.php" enctype="multipart/form-data">
                                                <input type="hidden" name="action" value="update">
                                                <input type="hidden" name="id" value="<?php echo $news['id']; ?>">
                                                <input type="hidden" name="current_image"
                                                    value="<?php echo htmlspecialchars($news['image']); ?>">

                                                <div class="mb-3">
                                                    <label for="title-<?php echo $news['id']; ?>"
                                                        class="form-label">Titre</label>
                                                    <input type="text" name="title" id="title-<?php echo $news['id']; ?>"
                                                        class="form-control"
                                                        value="<?php echo htmlspecialchars($news['title']); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="content-<?php echo $news['id']; ?>"
                                                        class="form-label">Contenu</label>
                                                    <textarea name="content" id="content-<?php echo $news['id']; ?>"
                                                        class="form-control" rows="4"
                                                        required><?php echo htmlspecialchars($news['content']); ?></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="image-<?php echo $news['id']; ?>"
                                                        class="form-label">Image</label>
                                                    <input type="file" name="image" id="image-<?php echo $news['id']; ?>"
                                                        class="form-control" accept="image/*">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="author-<?php echo $news['id']; ?>"
                                                        class="form-label">Auteur</label>
                                                    <input type="text" name="author" id="author-<?php echo $news['id']; ?>"
                                                        class="form-control"
                                                        value="<?php echo htmlspecialchars($news['author']); ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="status-<?php echo $news['id']; ?>"
                                                        class="form-label">Statut</label>
                                                    <select name="status" id="status-<?php echo $news['id']; ?>"
                                                        class="form-select">
                                                        <option value="draft" <?php echo $news['status'] === 'draft' ? 'selected' : ''; ?>>Brouillon</option>
                                                        <option value="published" <?php echo $news['status'] === 'published' ? 'selected' : ''; ?>>Publié</option>
                                                    </select>
                                                </div>
                                                <div class="text-end">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Annuler</button>
                                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Aucune actualité disponible.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>


        <!-- MODAL d'ajout de Actualité -->
        <div class="modal fade" id="addNewsModal" tabindex="-1" aria-labelledby="addNewsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg"> <!-- Utilisation de modal-lg pour agrandir le modal -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewsModalLabel">Ajouter une Actualité</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="manage_news.php" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="create">

                            <!-- Titre -->
                            <div class="mb-3">
                                <label for="title" class="form-label">Titre de l'actualité</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>

                            <!-- Contenu -->
                            <div class="mb-3">
                                <label for="content" class="form-label">Contenu</label>
                                <textarea name="content" id="content" class="form-control" rows="6" required></textarea>
                            </div>

                            <!-- Image -->
                            <div class="mb-3">
                                <label for="image" class="form-label">Image associée</label>
                                <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            </div>

                            <!-- Auteur -->
                            <div class="mb-3">
                                <label for="author" class="form-label">Auteur</label>
                                <input type="text" name="author" id="author" class="form-control" value="Admin">
                            </div>

                            <!-- Statut -->
                            <div class="mb-3">
                                <label for="status" class="form-label">Statut</label>
                                <select name="status" id="status" class="form-select" required>
                                    <option value="draft">Brouillon</option>
                                    <option value="published">Publié</option>
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

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- CKEditor Script -->
        <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
        <script>
            // Initialisation de CKEditor sur le textarea
            CKEDITOR.replace('content', {
                height: 300, // Hauteur personnalisée pour une meilleure expérience utilisateur
                removeButtons: 'Subscript,Superscript', // Supprimer les boutons inutiles
                toolbarGroups: [
                    { name: 'document', groups: ['mode', 'document', 'doctools'] },
                    { name: 'clipboard', groups: ['clipboard', 'undo'] },
                    { name: 'editing', groups: ['find', 'selection', 'spellchecker'] },
                    { name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
                    { name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph'] },
                    { name: 'links' },
                    { name: 'insert' },
                    { name: 'styles' },
                    { name: 'colors' },
                    { name: 'tools' }
                ]
            });
        </script>

</body>

</html>