<?php 
    include("../db_connection.php");
    include("./session-config.php");
    $Id_bricoleur = $_SESSION['bricoleurID'];
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
  <header class="container-fluid bg-light">
        <nav class="navbar navbar-expand-lg ">
            <div class="container-fluid">
                <a class="navbar-brand" href="profil">
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
                        <li class="nav-item">
                            <a class="nav-link" href="#blog">Blog</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav mb-2 mb-lg-0 pe-3">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo $_SESSION['bricoleurNom']; ?>
                                <i class="fa-sharp fa-solid fa-user fa-sm ml-2"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="logout">Déconnexion</a></li>
                            </ul>
                        </li>
                    </ul>
                    
                </div>
            </div>
        </nav>
    </header>
    <?php
        // Retrieve the user's current information from the database
        $stmt = $db_connection->prepare("SELECT * FROM bricoleur WHERE id_bricoleur = :bricoleurId");
        $stmt->bindParam(':bricoleurId', $Id_bricoleur);
        $stmt->execute();
        $userInfos = $stmt->fetch(PDO::FETCH_ASSOC);

        $nom = $userInfos['nom_bricoleur'];
        $prenom = $userInfos['prenom_bricoleur'];
        $telephone = $userInfos['tele_bricoleur'];
        $cin = $userInfos['cin_bricoleur'];
        $adresse = $userInfos['adresse_bricoleur'];
        $ville = $userInfos['ville_bricoleur'];
        $imgProfile = $userInfos['img_profile'];
        $email = $userInfos['email'];
        $mdp = $userInfos['mdp_bricoleur'];

        // Function to sanitize and validate input data
        function sanitizeInput($input)
        {
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

            // Perform validation checks on the input data
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
            } elseif (!preg_match('/^[A-Z]{2}\d{6}$/', $cin)) {
                $errors['cin'] = "Le champ 'CIN' doit respecter le format LL000000.";
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
            }

            if (empty($email)) {
                $errors['email'] = "Le champ 'Email' est requis.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Le champ 'Email' n'est pas valide.";
            }

            if (empty($mdp)) {
                $errors['mdp'] = "Le champ 'Mot de passe' est requis.";
            }

            // If there are no validation errors, proceed with updating the data in the database
            if (empty($errors)) {
                // Check if a new image is uploaded
                if (!empty($_FILES['img_profile']['name'])) {
                    // Move the uploaded file to the target folder
                    $targetFolder = '../images/bricoleur/profil/';
                    $targetFilename = uniqid() . '.' . $fileExtension;
                    $targetPath = $targetFolder . $targetFilename;

                    if (move_uploaded_file($imgProfile['tmp_name'], $targetPath)) {
                        // Update the user's information in the database
                        $stmt = $db_connection->prepare("UPDATE bricoleur SET nom_bricoleur = :nom, prenom_bricoleur = :prenom, tele_bricoleur = :telephone, cin_bricoleur = :cin, adresse_bricoleur = :adresse, ville_bricoleur = :ville, img_profile = :img_profile, email = :email, mdp_bricoleur = :mdp WHERE id_bricoleur = :bricoleurId");

                        // Bind the parameters
                        $stmt->bindParam(':nom', $nom);
                        $stmt->bindParam(':prenom', $prenom);
                        $stmt->bindParam(':telephone', $telephone);
                        $stmt->bindParam(':cin', $cin);
                        $stmt->bindParam(':adresse', $adresse);
                        $stmt->bindParam(':ville', $ville);
                        $stmt->bindParam(':img_profile', $targetPath);
                        $stmt->bindParam(':email', $email);
                        $stmt->bindParam(':mdp', $mdp);
                        $stmt->bindParam(':bricoleurId', $Id_bricoleur);

                        // Execute the query
                        if ($stmt->execute()) {
                            // Redirect the user to a success page
                            header('Location: success.php');
                            exit;
                        } else {
                            // Handle the database error
                            $errors['database'] = "Une erreur s'est produite lors de la mise à jour des données dans la base de données.";
                        }
                    } else {
                        $errors['img_profile'] = 'Erreur lors du déplacement du fichier vers le dossier de destination.';
                    }
                } else {
                    // Update the user's information in the database without changing the image
                    $stmt = $db_connection->prepare("UPDATE bricoleur SET nom_bricoleur = :nom, prenom_bricoleur = :prenom, tele_bricoleur = :telephone, cin_bricoleur = :cin, adresse_bricoleur = :adresse, ville_bricoleur = :ville, email = :email, mdp_bricoleur = :mdp WHERE id_bricoleur = :bricoleurId");

                    // Bind the parameters
                    $stmt->bindParam(':nom', $nom);
                    $stmt->bindParam(':prenom', $prenom);
                    $stmt->bindParam(':telephone', $telephone);
                    $stmt->bindParam(':cin', $cin);
                    $stmt->bindParam(':adresse', $adresse);
                    $stmt->bindParam(':ville', $ville);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':mdp', $mdp);
                    $stmt->bindParam(':bricoleurId', $Id_bricoleur);

                    // Execute the query
                    if ($stmt->execute()) {
                        // Redirect the user to a success page
                        header('Location: profil');
                        exit;
                    } else {
                        // Handle the database error
                        $errors['database'] = "Une erreur s'est produite lors de la mise à jour des données dans la base de données.";
                    }
                }
            }
        }
    ?>


<main>
    <section class="container justify-centent-center align-items-center mt-5">

        <div class="row bg-light">
            <!-- <div class="col-12 col-lg-4"></div> -->
            
            <div class="col-12 bg-white border rounded border-dark">
                <h2 class="py-4">Modification de vos informations personnelles</h2>
                <?php echo $userInfos['nom'];?>
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col form-group mb-3">
                            <label for="nom_bricoleur">Nom</label>
                            <input type="text" class="form-control  border-black" id="nom_bricoleur" name="nom_bricoleur" value="<?php echo $nom; ?>">
                            <?php if (isset($errors['nom'])) echo '<span class="text-danger">' . $errors['nom'] . '</span>'; ?>
                        </div>
                        <div class="col form-group mb-3">
                            <label for="prenom_bricoleur">Prénom</label>
                            <input type="text" class="form-control  border-black" id="prenom_bricoleur" name="prenom_bricoleur" value="<?php echo $prenom; ?>">
                            <?php if (isset($errors['prenom'])) echo '<span class="text-danger">' . $errors['prenom'] . '</span>'; ?>
                        </div>
                        <div class="col form-group mb-3">
                            <label for="cin_bricoleur">CIN</label>
                            <input type="text" class="form-control  border-black" id="cin_bricoleur" name="cin_bricoleur" value="<?php echo $cin; ?>">
                            <?php if (isset($errors['cin'])) echo '<span class="text-danger">' . $errors['cin'] . '</span>'; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group mb-3">
                            <label for="tele_bricoleur">Téléphone</label>
                            <input type="text" class="form-control  border-black" id="tele_bricoleur" name="tele_bricoleur" value="<?php echo $telephone; ?>">
                            <?php if (isset($errors['telephone'])) echo '<span class="text-danger">' . $errors['telephone'] . '</span>'; ?>
                        </div>
                        <div class="col form-group mb-3">
                            <label for="adresse_bricoleur">Adresse</label>
                            <input type="text" class="form-control  border-black" id="adresse_bricoleur" name="adresse_bricoleur" value="<?php echo $adresse; ?>">
                            <?php if (isset($errors['adresse'])) echo '<span class="text-danger">' . $errors['adresse'] . '</span>'; ?>
                        </div>
                        <div class="col form-group mb-3">
                            <label for="ville_bricoleur">Ville</label>
                            <input type="text" class="form-control  border-black" id="ville_bricoleur" name="ville_bricoleur" value="<?php echo $ville; ?>">
                            <?php if (isset($errors['ville'])) echo '<span class="text-danger">' . $errors['ville'] . '</span>'; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group mb-3">
                            <label for="img_profile">Image de profil</label>
                            <input type="file" class="form-control  border-black" id="img_profile" name="img_profile">
                            <?php if (isset($errors['img_profile'])) echo '<span class="text-danger">' . $errors['img_profile'] . '</span>'; ?>
                        </div>
                        <div class="col form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control  border-black" id="email" name="email" value="<?php echo $email; ?>">
                            <?php if (isset($errors['email'])) echo '<span class="text-danger">' . $errors['email'] . '</span>'; ?>
                        </div>
                        <div class="col form-group mb-3">
                            <label for="mdp_bricoleur">Mot de passe</label>
                            <div class="input-group">
                                <input type="password" class="form-control  border-black" id="passwordField" name="mdp_bricoleur" value="<?php echo $password; ?>">
                                <span class="input-group-text" id="basic-addon1">
                                    <input type="checkbox" onclick="togglePasswordVisibility()"> Afficher   
                                </span>
                            </div>
                            <?php if (isset($errors['mdp'])) echo '<span class="text-danger">' . $errors['mdp'] . '</span>'; ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark w-100  border-black">Enregistrer les modifications</button>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary me-md-2" type="button">Button</button>
                        <button class="btn btn-primary" type="button">Button</button>
                    </div>
                </form>

            </div>
        </div>
    </section>
</main>


    </main>

    <footer class="container-fluid bg-dark">
        
    </footer>

    <script>
        // add a class to all input fields to maje the border rounded-0 and color black
        document.getElementByTagName("input").add
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("passwordField");
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