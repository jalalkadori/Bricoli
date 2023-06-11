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
    <header class="container-fluid bg-light fixed-top">
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
                            <a class="nav-link" href="login">S'inscrire<i class="fa-solid fa-right-to-bracket"></i></a> 
                        </li>
                    </ul>
                    
                </div>
            </div>
        </nav>
    </header>
    <?php
        // Function to sanitize and validate input data
        function sanitizeInput($input) {
            // Remove leading and trailing whitespace
            $input = trim($input);
            return $input;
        }
        // Initialize an array to store validation errors
        $errors = [];

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve form data and sanitize inputs
            $nom = sanitizeInput($_POST['nom_bricoleur']);
            $prenom = sanitizeInput($_POST['prenom_bricoleur']);
            $telephone = sanitizeInput($_POST['tele_bricoleur']);
            $cin = sanitizeInput($_POST['cin_bricoleur']);
            $adresse = sanitizeInput($_POST['adresse_bricoleur']);
            $ville = sanitizeInput($_POST['ville_bricoleur']);
            $imgProfile = $_FILES['img_profile'];
            $email = sanitizeInput($_POST['email']);
            $mdp = sanitizeInput($_POST['mdp_bricoleur']);

            // Perform your validation checks on the input data
            if (empty($nom)) {
                $errors['nom'] = "Le champ 'Nom' est requis.";
            }

            if (empty($prenom)) {
                $errors['prenom'] = "Le champ 'Prénom' est requis.";
            }

            if (empty($telephone)) {
                $errors['telephone'] = "Le champ 'Téléphone' est requis.";
            } elseif (!preg_match('/^\d{10}$/', $telephone)) {
                $errors['telephone'] = "Le champ 'Téléphone' doit contenir 10 chiffres.";
            }

            if (empty($cin)) {
                $errors['cin'] = "Le champ 'CIN' est requis.";
            } elseif (!preg_match('/^\d{8}$/', $cin)) {
                $errors['cin'] = "Le champ 'CIN' doit contenir 8 chiffres.";
            }

            if (empty($adresse)) {
                $errors['adresse'] = "Le champ 'Adresse' est requis.";
            }

            if (empty($ville)) {
                $errors['ville'] = "Le champ 'Ville' est requis.";
            }

            // Check if a new image is uploaded
            if (!empty($_FILES['img_profile']['name'])) {
                $imgProfile = $_FILES['img_profile'];

                // Check if there is an error in the uploaded file
                if ($imgProfile['error'] !== UPLOAD_ERR_OK) {
                    $errors['img_profile'] = 'Une erreur est survenue lors du téléchargement du fichier.';
                } else {
                    // Validate the image file
                    $allowedExtensions = ['jpg', 'jpeg', 'png'];
                    $maxFileSize = 2 * 1024 * 1024; // 2MB

                    // Get the file extension
                    $fileExtension = strtolower(pathinfo($imgProfile['name'], PATHINFO_EXTENSION));

                    // Check if the file extension is allowed
                    if (!in_array($fileExtension, $allowedExtensions)) {
                        $errors['img_profile'] = 'Extension de fichier invalide. Seuls les fichiers JPG, JPEG et PNG sont autorisés.';
                    }

                    // Check if the file size is within the limit
                    if ($imgProfile['size'] > $maxFileSize) {
                        $errors['img_profile'] = 'La taille du fichier dépasse la limite maximale de 2 Mo.';
                    }
                }
            } else {
                // No file chosen
                $errors['img_profile'] = 'Veuillez choisir votre image de profil.';
            }


            if (empty($email)) {
                $errors['email'] = "Le champ 'Email' est requis.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Le champ 'Email' n'est pas valide.";
            }

            if (empty($mdp)) {
                $errors['mdp'] = "Le champ 'Mot de passe' est requis.";
            }

            // If there are no validation errors, proceed with inserting the data into the database
            if (empty($errors)) {
                $imgProfilePath = 'uploads/' . $imgProfile['name'];
                //move the file to the destination folder
                $targetFolder = 'images/bricoleur/profil/';
                $targetFilename = uniqid() . '.' . $fileExtension;
                $targetPath = $targetFolder . $targetFilename;
                // Move the uploaded file to the target folder
                if (move_uploaded_file($imgProfile['tmp_name'], $targetPath)) {
                    // File moved successfully
                } else {
                    $errors['img_profile'] = 'Error moving the file to the destination folder.';
                }

                // Hash the password
                $hashedPassword = password_hash($mdp, PASSWORD_DEFAULT);
                // Prepare the INSERT statement
                $stmt = $db_connection->prepare("INSERT INTO bricoleur (id_bricoleur, nom_bricoleur, prenom_bricoleur, tele_bricoleur, cin_bricoleur, adresse_bricoleur, ville_bricoleur, img_profile, email, mdp_bricoleur, id_admin) VALUES (NULL, :nom, :prenom, :telephone, :cin, :adresse, :ville, :img_profile, :email, :mdp, 1)");

                // Bind the parameters
                $stmt->bindParam(':nom', $nom);
                $stmt->bindParam(':prenom', $prenom);
                $stmt->bindParam(':telephone', $telephone);
                $stmt->bindParam(':cin', $cin);
                $stmt->bindParam(':adresse', $adresse);
                $stmt->bindParam(':ville', $ville);
                $stmt->bindParam(':img_profile', $imgProfilePath);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':mdp', $hashedPassword);

                // Execute the query
                if ($stmt->execute()) {
                    // Redirect the user to a success page
                    header('Location: login.php');
                    exit;
                } else {
                    // Handle the database error
                    $errors['database'] = "Une erreur s'est produite lors de l'ajout des données dans la base de données.";
                }
            }
        }
    ?>

<main>
    <section class="container justify-centent-center align-items-center mt-5 py-5 vh-75 ">

        <div class="row py-5 bg-light">
            <div class="col-4"></div>
            <div class="col-8">
                <h2>Accédez à votre compte BRIKOLI</h2>

                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control rounded-0" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                        <?php if (isset($errors['email'])) echo '<span class="text-danger">' . $errors['email'] . '</span>'; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="mdp_bricoleur">Mot de passe</label>
                        <input type="password" class="form-control rounded-0" id="mdp_bricoleur" name="mdp_bricoleur" value="<?php echo isset($_POST['mdp_bricoleur']) ? htmlspecialchars($_POST['mdp_bricoleur']) : ''; ?>">
                        <?php if (isset($errors['mdp'])) echo '<span class="text-danger">' . $errors['mdp'] . '</span>'; ?>
                    </div>
                    <button type="submit" class="btn btn-black rounded-0">S'inscrire</button>
                </form>
            </div>
        </div>
    </section>
</main>


    </main>

    <footer class="container-fluid bg-dark">
        
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>