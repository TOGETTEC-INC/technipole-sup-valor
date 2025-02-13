<?php
session_start();

// Charger la connexion PDO
require_once './admin/config/database.php';

// Initialiser les variables pour les messages d'erreur/succès
$errors = [];
$success = false;

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $fullName = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $projectName = trim($_POST['project_name'] ?? '');
    $sector = trim($_POST['sector'] ?? '');
    $description = trim($_POST['description'] ?? '');
    
    // Valider les champs obligatoires
    if (empty($fullName)) $errors[] = "Le nom complet est obligatoire.";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Une adresse email valide est obligatoire.";
    if (empty($phone)) $errors[] = "Le numéro de téléphone est obligatoire.";
    if (empty($projectName)) $errors[] = "Le nom du projet est obligatoire.";
    if (empty($sector)) $errors[] = "Le secteur d'activité est obligatoire.";
    if (empty($description)) $errors[] = "La description du projet est obligatoire.";

    // Vérifier si un fichier a été uploadé
    $uploadedFilePath = '';
    if (isset($_FILES['document']) && $_FILES['document']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . './admin/uploads/applications/';

        $fileName = uniqid('doc_', true) . '.' . pathinfo($_FILES['document']['name'], PATHINFO_EXTENSION);
        $uploadedFilePath = $uploadDir . $fileName;

        if (!move_uploaded_file($_FILES['document']['tmp_name'], $uploadedFilePath)) {
            $errors[] = "Erreur lors du téléchargement du document.";
        } else {
            // Conserver le chemin relatif
            $uploadedFilePath = './admin/uploads/applications/' . $fileName;
        }
    }

    // Si aucune erreur, insérer les données dans la base de données
    if (empty($errors)) {
        try {
            $sql = "INSERT INTO applications (full_name, email, phone, project_name, sector, description, document_path) 
                    VALUES (:full_name, :email, :phone, :project_name, :sector, :description, :document_path)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':full_name', $fullName);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':phone', $phone);
            $stmt->bindValue(':project_name', $projectName);
            $stmt->bindValue(':sector', $sector);
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':document_path', $uploadedFilePath);
            $stmt->execute();

            $success = true;
        } catch (PDOException $e) {
            $errors[] = "Erreur lors de l'enregistrement dans la base de données : " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processus de Candidature</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <div class="container my-5">
        <?php if ($success): ?>
            <div class="alert alert-success text-center">
                <h4 class="fw-bold">Votre candidature a été soumise avec succès !</h4>
                <p>Nous examinerons votre dossier et vous contacterons prochainement.</p>
                <a href="index.php" class="btn btn-primary">Retour à l'accueil</a>
            </div>
        <?php else: ?>
            <div class="alert alert-danger">
                <h4 class="fw-bold">Une erreur est survenue</h4>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
                <a href="apply.php" class="btn btn-secondary mt-3">Retourner au formulaire</a>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
