<?php
    // Vérifier la session
    session_start();
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: login.php');
        exit;
    }
    // Vous pouvez récupérer le nom de l'administrateur
    $adminName = $_SESSION['admin_username'] ?? 'Admin';
?>


<style>
    /* Hauteur du header pour un layout fixe */
    .navbar {
        height: 60px;
    }

    /* Sidebar fixe à gauche */
    #sidebar {
        width: 240px;
        position: fixed;
        top: 60px;
        /* hauteur du .navbar */
        bottom: 0;
        left: 0;
        padding: 1rem;
        background-color: #f8f9fa;
        overflow-y: auto;
    }

    /* Contenu principal décalé par la sidebar */
    #main-content {
        margin-left: 240px;
        /* même largeur que la sidebar */
        margin-top: 60px;
        /* même hauteur que la navbar */
        padding: 1rem;
    }

    .sidebar-link {
        text-decoration: none;
        color: #333;
        display: block;
        padding: 0.5rem 0;
        border-radius: 4px;
    }

    .sidebar-link:hover {
        background-color: #e9ecef;
    }
</style>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="admin.php">
            <i class="fa-solid fa-user-cog"></i> Espace Admin
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin"
            aria-controls="navbarAdmin" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarAdmin">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item me-3">
                    <span class="nav-link disabled text-white">
                        Bonjour, <strong><?php echo htmlspecialchars($adminName); ?></strong>
                    </span>
                </li>
                <li class="nav-item">
                    <form method="POST" action="logout.php" class="d-inline">
                        <button class="btn btn-outline-light" type="submit">
                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>