<?php
// public/login.php
session_start();
require_once __DIR__ . '/config/database.php'; // Connexion $pdo

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: admin.php');
    exit;
}



// Déclaration de variables pour l’affichage des erreurs
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!empty($username) && !empty($password)) {
        $sql = 'SELECT * FROM admin_users WHERE username = :username LIMIT 1';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $adminUser = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($adminUser && password_verify($password, $adminUser['password'])) {
            // Mot de passe correct -> On crée la session
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $adminUser['username'];

            // Redirection vers la page admin
            header('Location: admin.php');
            exit;
        } else {
            $errorMessage = 'Identifiants invalides.';
        }
    } else {
        $errorMessage = 'Veuillez remplir tous les champs.';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion Admin</title>
  <!-- Lien vers Bootstrap 5 (CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Centrer verticalement dans la page */
    body, html {
      height: 100%;
      margin: 0;
      padding: 0;
    }
    .login-container {
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #f8f9fa; /* Gris clair */
    }
  </style>
</head>
<body>
<div class="login-container">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm">
          <div class="card-body p-4">
            <h2 class="card-title text-center mb-4">Espace Admin</h2>

            <!-- Affichage de l'erreur si nécessaire -->
            <?php if (!empty($errorMessage)): ?>
              <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
            <?php endif; ?>

            <form method="POST" action="login.php">
              <div class="mb-3">
                <label for="username" class="form-label">Nom d’utilisateur</label>
                <input 
                  type="text"
                  class="form-control"
                  id="username"
                  name="username"
                  required
                >
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input
                  type="password"
                  class="form-control"
                  id="password"
                  name="password"
                  required
                >
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Se connecter</button>
              </div>
            </form>

          </div><!-- Fin card-body -->
        </div><!-- Fin card -->
      </div><!-- Fin col -->
    </div><!-- Fin row -->
  </div><!-- Fin container -->
</div><!-- Fin login-container -->

<!-- Script Bootstrap (optionnel pour interactions JavaScript) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
