<?php 
    include("../db_connection.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bricoleur | Inscription</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/bricoleur-style.css">
    <script src="https://kit.fontawesome.com/75c6b1327b.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>
    <?php
        // in case of password change
        // Check if the 'success' key is set in the $_GET array
        if (isset($_GET['success'])) {
            $successMessage = $_GET['success'];
        }

        // Function to verify the entered password against the stored hashed password
        function verifyPassword($password, $hashedPassword) {
            return password_verify($password, $hashedPassword);
        }

        // Initialize variables
        $email = $password = $emailError = $passwordError = '';

        // Check if the login form is submitted
        if (isset($_POST['connecter'])) {
            // Validate and sanitize the email input
            if (empty($_POST['email'])) {
                $emailError = 'Veuillez saisir votre adresse email.';
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $emailError = 'Veuillez saisir une adresse email valide.';
            } else {
                $email = $_POST['email'];
            }

            // Validate and sanitize the password input
            if (empty($_POST['password'])) {
                $passwordError = 'Veuillez saisir votre mot de passe.';
            } else {
                $password = $_POST['password'];
            }

            // Proceed with login if no validation errors
            if (empty($error)) {
                // Retrieve the stored hashed password from the database for the entered email
                $stmt = $db_connection->prepare("SELECT * FROM `chercheur` WHERE email_chercheur = ?");
                $stmt->execute([$email]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // Check if the email exists in the database
                if ($row) {
                    $storedHashedPassword = $row['mdp_chercheur'];

                    // Verify the entered password against the stored hashed password
                    if (verifyPassword($password, $storedHashedPassword)) {
                        // Password is correct, proceed with the login
                        session_start();
                        // Set the session expiration time to 30 minutes (in seconds)
                        $_SESSION['expiration_time'] = time() + 30 * 60;
                       
                        //store any necessary user data
                        $_SESSION['chrcheurEmail'] = $email;
                        $_SESSION['chrcheurNom'] = $row['nom_chercheur'];
                        $_SESSION['chrcheurPrenom'] = $row['prenom_chercheur'];
                        $_SESSION['chrcheurID'] = $row['id_chrcheur'];
                        // Redirect the user to the dashboard page
                        header("Location: ../index.php");
                        exit();
                    } else {
                        // Password is incorrect
                        $passwordError = "Mot de passe incorrect. Veuillez réessayer.";
                    }
                } else {
                    // Email does not exist in the database
                    $emailError = "Adresse Email introuvable, Veuillez réessayer. ";
                }
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
                                <a class="nav-link" href="./signup">S'inscrire <i class="fa-solid fa-user-plus"></i></a>
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
                    <!-- in case of password change Display the success -->
                    <?php if (!empty($successMessage)) : ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $successMessage; ?>
                        </div>
                    <?php endif; ?>
                    <h2 class="text-center">Accédez à votre compte BRICOLI</h2>
                     
                    <form method="post" action="login.php" class="w-100">
                        <div class=" px-2">
                            <div class="mb-3">
                                <label for="email" class="form-label ">Address Email </label>
                                <input type="email" class="form-control border-dark" name="email">
                            </div>
                            <?php if (!empty($emailError)) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $emailError; ?>
                                </div>
                            <?php endif; ?>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de pass</label>
                                <div class="password-toggle">
                                    <input type="password" class="form-control border-dark" id="password" name="password" value="">
                                    <span class="toggle-icon" onclick="togglePasswordVisibility()">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                            <?php if (!empty($passwordError)) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $passwordError; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="./password-reset.php" class="btn text-danger text-start">Mot de pass oublié ?</a>
                            <button type="submit" class="btn btn-dark" name="connecter">Se connecter</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>

    
    <script src="../js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>