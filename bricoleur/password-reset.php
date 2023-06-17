<?php 
    include("../db_connection.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bricoleur</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/bricoleur-style.css">
    <script src="https://kit.fontawesome.com/75c6b1327b.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>
    <?php
        function sanitizeInput($input)
        {
            $input = trim($input);
            $input = htmlspecialchars($input);
            return $input;
        }

        // Initialize variables
        $cin = "";
        $oldPassword = "";
        $newPassword = "";
        $errorMessage = [];
        $passChangeMessage = "";
        $user = null;

        // Check if the form is submitted
        if (isset($_POST['passwordChange'])) {
            // Retrieve and sanitize input data
            $cin = sanitizeInput($_POST['cin']);
            $oldPassword = sanitizeInput($_POST['old_password']);
            $newPassword = sanitizeInput($_POST['new_password']);

            // Validate the CIN
            if (empty($cin)) {
                // Display an error message if the CIN field is empty
                $errorMessage['cin'] = "Le champ CIN est obligatoire.";
            } elseif (!preg_match("/^[A-Za-z0-9]{8}$/", $cin)) {
                // Display an error message if the CIN is not in the correct format
                $errorMessage['cin'] = "Le CIN doit être composé de 8 caractères alphanumériques.";
            }

            // Check if the CIN exists in the database only if there are no previous validation errors
            if (empty($errorMessage['cin'])) {
                // Check if the CIN exists in the database
                $stmt = $db_connection->prepare("SELECT * FROM bricoleur WHERE cin_bricoleur = :cin");
                $stmt->bindParam(':cin', $cin);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$user) {
                    // Display an error message if the CIN does not exist in the database
                    $errorMessage['cin'] = "CIN invalide. Veuillez entrer un CIN valide.";
                }
            }

            if ($user) {
                // Check if the old password matches
                if (password_verify($oldPassword, $user['mdp_bricoleur'])) {
                    // Validate the new password
                    if (strlen($newPassword) < 8) {
                        // Display an error message if the password is too short
                        $errorMessage['newPassword'] = "Le nouveau mot de passe doit comporter au moins 8 caractères.";
                    } elseif (!preg_match("/[A-Z]/", $newPassword)) {
                        // Display an error message if the password doesn't contain an uppercase letter
                        $errorMessage['newPassword'] = "Le nouveau mot de passe doit contenir au moins une lettre majuscule.";
                    } elseif (!preg_match("/[a-z]/", $newPassword)) {
                        // Display an error message if the password doesn't contain a lowercase letter
                        $errorMessage['newPassword'] = "Le nouveau mot de passe doit contenir au moins une lettre minuscule.";
                    } elseif (!preg_match("/[0-9]/", $newPassword)) {
                        // Display an error message if the password doesn't contain a digit
                        $errorMessage['newPassword'] = "Le nouveau mot de passe doit contenir au moins un chiffre.";
                    } else {
                        // Hash the new password
                        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                        // Update the user's password in the database
                        $stmt = $db_connection->prepare("UPDATE bricoleur SET mdp_bricoleur = :password WHERE cin_bricoleur = :cin");
                        $stmt->bindParam(':password', $hashedPassword);
                        $stmt->bindParam(':cin', $cin);

                        if ($stmt->execute()) {
                            // Password updated successfully
                            $passChangeMessage = "Votre mot de passe a été mis à jour avec succès.";

                            // Redirect to the login page with the success message in the URL
                            header("Location: login.php?success=" . urlencode($passChangeMessage));
                            exit;
                        } else {
                            // Display an error message
                            $errorMessage['fail'] = "Erreur lors de la mise à jour du mot de passe. Veuillez réessayer.";
                        }
                    }
                } else {
                    // Display an error message if the old password is incorrect
                    $errorMessage['oldPassword'] = "Ancien mot de passe incorrect. Veuillez réessayer.";
                }
            } else {
                // Display an error message if the CIN does not exist in the database
                $errorMessage['cin'] = "CIN invalide. Veuillez entrer un CIN valide.";
            }
        }
    ?>

        <main class="position-relative vh-100">
            <header class="container-fluid bg-white">
                <nav class="navbar navbar-expand-lg ">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="../index.php">
                            <img src="../logo/logo1500.png" alt="bricoli logo" srcset="bricoli logo" width="150">
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse fw-semibold text-uppercase" id="navbarSupportedContent">
                            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link" href="contacte">Contactez-Nous</a>
                                </li>
                            </ul>
                            <ul class="navbar-nav mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link" href="login">Se Connecter <i class="fa-solid fa-right-to-bracket"></i></a> 
                                </li>
                            </ul>

                        </div>
                    </div>
                </nav>
            </header>
            <section class="container center-content rounded-5 container-shadow mt-5 m-md-0 m-lg-0">
                <div class="row py-5 bg-white align-items-center">
                    <div class="col-12 col-lg-4 d-none d-lg-flex">
                        <img src="../images/bricoleur/illustrations/login.svg" class="" alt="login illustration" srcset="login illustration">
                    </div>
                    <div class="col-12 col-lg-8">
                        <h2>Réinitialisation de mot de passe</h2>
                        <?php if (!empty($errorMessage['fail'])) { ?>
                            <p><?php echo $errorMessage['fail']; ?></p>
                        <?php } ?>
                        <form method="POST">
                            <div class="mb-3">
                                <label for="cin" class="form-label">CIN :</label>
                                <input type="text" class="form-control border-dark" name="cin" value="<?php echo htmlspecialchars($cin); ?>">
                                <?php if (isset($errorMessage['cin'])) echo '<span class="text-danger">' . $errorMessage['cin'] . '</span>'; ?>
                            </div>
                            <div class="mb-3">
                                <label for="old_password" class="form-label">Ancien mot de passe :</label>
                                <div class="input-group">
                                    <input type="password" class="form-control border-dark" id="oldPassword" name="old_password" value="<?php echo htmlspecialchars($oldPassword); ?>">
                                    <span class="input-group-text border-dark bg-white">
                                        <input type="checkbox" class="form-check-input border border-dark" onclick="togglePasswordVisibility('oldPassword')">
                                    </span>
                                </div>
                                <?php if (isset($errorMessage['oldPassword'])) echo '<span class="text-danger">' . $errorMessage['oldPassword'] . '</span>'; ?>
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label">Nouveau mot de passe :</label>
                                <div class="input-group">
                                    <input type="password" class="form-control border-dark" id="newPassword" name="new_password" value="<?php echo htmlspecialchars($newPassword); ?>">
                                    <span class="input-group-text border-dark bg-white">
                                        <input type="checkbox" class="form-check-input border border-dark" onclick="togglePasswordVisibility('newPassword')">
                                    </span>
                                </div>
                                <?php if (isset($errorMessage['newPassword'])) echo '<span class="text-danger">' . $errorMessage['newPassword'] . '</span>'; ?>
                            </div>
                            <div class="mb-3">
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end py-2">
                                    <a href="login" class="btn text-primary text-start">Se connecter ?</a>
                                    <button type="submit" class="btn btn-success" name="passwordChange">Réinitialiser le mot de passe</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </main>

    
        <script>
        /*******************
         * hide and show the password feild whebe clicking on the checkbox 
         *******************/
        function togglePasswordVisibility(fieldId) {
            var passwordField = document.getElementById(fieldId);
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </body>
</html>