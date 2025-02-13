<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postuler - Technipole Sup Valor</title>
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

        .form-section {
            background-color: #f7f7f5;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        }

        .form-section:hover {
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php include 'components/header.php'; ?>

    <!-- Hero Section -->
    <section class="bg-orange text-white text-center py-5">
        <div class="container">
            <h1 class="display-4 fw-bold">Rejoignez le Technipole Sup Valor</h1>
            <p class="lead">Postulez pour intégrer notre programme et donner vie à votre idée ou startup.</p>
        </div>
    </section>

    <section class="container my-5">
        <h2 class="text-center text-orange mb-4">Formulaire de candidature</h2>
        <div class="form-section mx-auto col-lg-8">
            <form method="POST" action="process_application.php" enctype="multipart/form-data" class="needs-validation"
                novalidate>
                <!-- Nom complet -->
                <div class="mb-4 position-relative">
                    <label for="full_name" class="form-label fw-bold text-orange">Nom complet</label>
                    <input type="text" name="full_name" id="full_name" class="form-control form-control-lg"
                        placeholder="Votre nom complet" required>
                    <div class="invalid-feedback">Veuillez renseigner votre nom complet.</div>
                </div>

                <!-- Email -->
                <div class="mb-4 position-relative">
                    <label for="email" class="form-label fw-bold text-orange">Adresse Email</label>
                    <input type="email" name="email" id="email" class="form-control form-control-lg"
                        placeholder="Votre email" required>
                    <div class="invalid-feedback">Veuillez entrer une adresse email valide.</div>
                </div>

                <!-- Téléphone -->
                <div class="mb-4 position-relative">
                    <label for="phone" class="form-label fw-bold text-orange">Téléphone</label>
                    <input type="tel" name="phone" id="phone" class="form-control form-control-lg"
                        placeholder="Votre numéro de téléphone" required>
                    <div class="invalid-feedback">Veuillez renseigner un numéro de téléphone valide.</div>
                </div>

                <!-- Projet -->
                <div class="mb-4 position-relative">
                    <label for="project_name" class="form-label fw-bold text-orange">Nom du projet</label>
                    <input type="text" name="project_name" id="project_name" class="form-control form-control-lg"
                        placeholder="Nom de votre projet ou startup" required>
                    <div class="invalid-feedback">Veuillez renseigner le nom de votre projet.</div>
                </div>

                <!-- Secteur d'activité -->
                <div class="mb-4 position-relative">
                    <label for="sector" class="form-label fw-bold text-orange">Secteur d'activité</label>
                    <select name="sector" id="sector" class="form-select form-select-lg" required>
                        <option value="">Sélectionnez un secteur</option>
                        <option value="TIC">TIC</option>
                        <option value="Industrie">Industrie</option>
                        <option value="Agriculture">Agriculture</option>
                        <option value="Élevage">Élevage</option>
                        <option value="Autres">Autres</option>
                    </select>
                    <div class="invalid-feedback">Veuillez sélectionner un secteur d'activité.</div>
                </div>

                <!-- Description du projet -->
                <div class="mb-4 position-relative">
                    <label for="description" class="form-label fw-bold text-orange">Description du projet</label>
                    <textarea name="description" id="description" class="form-control form-control-lg" rows="5"
                        placeholder="Décrivez brièvement votre projet..." required></textarea>
                    <div class="invalid-feedback">Veuillez fournir une description de votre projet.</div>
                </div>

                <!-- Document (Ex: Business Plan) -->
                <div class="mb-4 position-relative">
                    <label for="document" class="form-label fw-bold text-orange">Document associé (facultatif)</label>
                    <input type="file" name="document" id="document" class="form-control form-control-lg"
                        accept=".pdf,.doc,.docx">
                    <small class="text-muted">Formats acceptés : PDF, DOC, DOCX.</small>
                </div>

                <!-- Boutons -->
                <div class="text-end">
                    <button type="reset" class="btn btn-outline-secondary btn-lg me-2">Réinitialiser</button>
                    <button type="submit" class="btn btn-orange text-white btn-lg"
                        style="background-color: #FF6600;">Soumettre</button>
                </div>
            </form>
        </div>
    </section>

    <script>
        // Script pour activer la validation Bootstrap
        (function () {
            'use strict';
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>


    <!-- Call to Action -->
    <section class="bg-light py-5 text-center">
        <div class="container">
            <h2 class="text-orange fw-bold">Besoin d'aide pour postuler ?</h2>
            <p class="lead">Contactez-nous pour toute question ou assistance.</p>
            <a href="contact.php" class="btn btn-orange text-white btn-lg" style="background-color: #FF6600;">Nous
                contacter</a>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>