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
        // Function to sanitize and validate input data
        function sanitizeInput($input) {
            // Remove leading and trailing whitespace
            $input = trim($input);
            return $input;
        }
        // Fetch the categories from the JSON file
        $villeData = file_get_contents('../json/ville.json');
        $villes = json_decode($villeData, true);

        // Initialize an array to store validation errors
        $errors = [];

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve form data and sanitize inputs
            $nom = sanitizeInput($_POST['nom_chercheur']);
            $prenom = sanitizeInput($_POST['prenom_chercheur']);
            $telephone = sanitizeInput($_POST['tele_chercheur']);
            $adresse = sanitizeInput($_POST['adresse_chercheur']);
            $ville = sanitizeInput($_POST['ville_chercheur']);
            $email = sanitizeInput($_POST['email_chercheur']);
            $mdp = sanitizeInput($_POST['mdp_chercheur']);

            // Perform your validation checks on the input data
            if (empty($nom)) {
                $errors['nom'] = "Veuillez entrer votre nom.";
            }

            if (empty($prenom)) {
                $errors['prenom'] = "Veuillez entrer votre Prénom.";
            }

            if (empty($telephone)) {
                $errors['telephone'] = "Veuillez entrer votre numéro de Téléphone.";
            } elseif (!preg_match('/^(06|07|08)\d{8}$/', $telephone)) {
                $errors['telephone'] = "Le numero de Téléphone doit commencer par 06, 07 ou 08 et contenir 10 chiffres au total.";
            }          

            if (empty($adresse)) {
                $errors['adresse'] = "Veuillez entrer votre Adresse.";
            }

            if (empty($ville)) {
                $errors['ville'] = "Veuillez delectionner votre Ville.";
            }
            // email validation : 
            // Check if the email already exists in the database
            $stmt = $db_connection->prepare("SELECT COUNT(*) FROM chercheur WHERE email_chercheur = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                $errors['email'] = "Cette adresse email est déjà utilisée.";
            }

            if (empty($email)) {
                $errors['email'] = "Veuillez entrer votre adresse email.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "L'adresse email n'est pas valide.";
            }
            if (empty($mdp)) {
                $errors['mdp'] = "Veuillez choisir un mot de passe.";
            } elseif (strlen($mdp) < 8) {
                $errors['mdp'] = "Le Mot de passe doit contenir au moins 8 caractères.";
            } elseif (!preg_match('/[A-Z]/', $mdp)) {
                $errors['mdp'] = "Le Mot de passe doit contenir au moins une lettre majuscule.";
            } elseif (!preg_match('/[a-z]/', $mdp)) {
                $errors['mdp'] = "Le Mot de passe doit contenir au moins une lettre minuscule.";
            } elseif (!preg_match('/\d/', $mdp)) {
                $errors['mdp'] = "Le Mot de passe doit contenir au moins un chiffre.";
            } elseif (!preg_match('/[^A-Za-z\d]/', $mdp)) {
                $errors['mdp'] = "Le Mot de passe doit contenir au moins un caractère spécial.";
            }

            // If there are no validation errors, proceed with inserting the data into the database
            if (empty($errors)) {
                // Hash the password
                $hashedPassword = password_hash($mdp, PASSWORD_DEFAULT);
                // Prepare the INSERT statement
                $stmt = $db_connection->prepare("INSERT INTO chercheur (id_chercheur, nom_chercheur, prenom_chercheur, tele_chercheur, adresse_chercheur, ville_chercheur, email_chercheur, mdp_chercheur) VALUES (NULL, :nom, :prenom, :telephone, :adresse, :ville, :email, :mdp)");

                // Bind the parameters
                $stmt->bindParam(':nom', $nom);
                $stmt->bindParam(':prenom', $prenom);
                $stmt->bindParam(':telephone', $telephone);
                $stmt->bindParam(':adresse', $adresse);
                $stmt->bindParam(':ville', $ville);
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

<main class="position-relative vh-100">
    <header class="container-fluid bg-light sticky-top">
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

    <section class="container center-content border rounded container-shadow my-5 my-md-0 my-lg-0">
        <div class="row py-3 bg-white">
            <div class="col-12 col-lg-4 d-flex justify-content-center align-items-center d-none d-lg-flex">
                <img src="../images/bricoleur/illustrations/login.svg" class="" alt="login illustration" srcset="login illustration">
            </div> 
            <div class="col-12 col-lg-8 d-flex flex-column justify-content-center ">
                <h2>Créez votre compte BRICOLI</h2>
                <hr class="border border-warning border-2 opacity-25">
                <form method="POST" action="" enctype="multipart/form-data">

                    <div class="row row-cols-1 row-cols-md-3">
                        <div class="form-group mb-3">
                            <label for="nom_chercheur">Nom</label>
                            <input type="text" class="form-control border-black" id="nom_chercheur" name="nom_chercheur" value="<?php echo isset($_POST['nom_chercheur']) ? htmlspecialchars($_POST['nom_chercheur']) : ''; ?>">
                            <?php if (isset($errors['nom'])) echo '<span class="text-danger">' . $errors['nom'] . '</span>'; ?>
                        </div>
                        <div class="form-group mb-3">
                            <label for="prenom_chercheur">Prénom</label>
                            <input type="text" class="form-control border-black" id="prenom_bricoleur" name="prenom_chercheur" value="<?php echo isset($_POST['prenom_chercheur']) ? htmlspecialchars($_POST['prenom_chercheur']) : ''; ?>">
                            <?php if (isset($errors['prenom'])) echo '<span class="text-danger">' . $errors['prenom'] . '</span>'; ?>
                        </div>
                        <div class="form-group mb-3">
                            <label for="tele_chercheur">Téléphone</label>
                            <input type="text" class="form-control border-black" id="tele_chercheur" name="tele_chercheur" value="<?php echo isset($_POST['tele_chercheur']) ? htmlspecialchars($_POST['tele_chercheur']) : ''; ?>">
                            <?php if (isset($errors['telephone'])) echo '<span class="text-danger">' . $errors['telephone'] . '</span>'; ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group mb-3 col-12 col-md-8">
                            <label for="adresse_chercheur">Adresse</label>
                            <input type="text" class="form-control border-black" id="adresse_chercheur" name="adresse_chercheur" value="<?php echo isset($_POST['adresse_chercheur']) ? htmlspecialchars($_POST['adresse_chercheur']) : ''; ?>">
                            <?php if (isset($errors['adresse'])) echo '<span class="text-danger">' . $errors['adresse'] . '</span>'; ?>
                        </div>
                        <div class="form-group mb-3 col-12 col-md-4">
                            <label for="ville_chercheur">Ville</label>
                            <select name="ville_chercheur" id="ville_chercheur" class="form-select rounded-0 border border-dark">
                                <option>Choisir votre ville</option>
                                <!-- create options (ville) for the select input based on the json file -->
                                <?php foreach ($villes as $ville) : ?>
                                    <!-- checks if $_POST['ville_chercheur'] is set and if it matches the current option value. If both conditions are met, the selected attribute will be added to that option. This ensures that the submitted value remains selected without any warning. -->
                                    <option value="<?php echo $ville['ville']; ?>" <?php echo (isset($_POST['ville_chercheur']) && $_POST['ville_chercheur'] == $ville['ville']) ? 'selected' : ''; ?>>
                                        <?php echo $ville['ville']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                            <?php if (isset($errors['ville'])) echo '<span class="text-danger">' . $errors['ville'] . '</span>'; ?>
                        </div>
                    </div>

                    <div class="row row-cols-1 row-cols-md-2">  
                        <div class="form-group mb-3">
                            <label for="email_chercheur">Email</label>
                            <input type="email" class="form-control border-black" id="email_chercheur" name="email_chercheur" value="<?php echo isset($_POST['email_chercheur']) ? htmlspecialchars($_POST['email_chercheur']) : ''; ?>">
                            <?php if (isset($errors['email'])) echo '<span class="text-danger">' . $errors['email'] . '</span>'; ?>
                        </div>
                        <div class="form-group mb-3">
                            <label for="mdp_chercheur">Mot de passe</label>
                            <div class="password-toggle">
                                <input type="password" class="form-control border-black border border-dark" id="password" name="mdp_chercheur" value="<?php echo isset($_POST['mdp_chercheur']) ? htmlspecialchars($_POST['mdp_chercheur']) : ''; ?>">
                                <span class="toggle-icon" onclick="togglePasswordVisibility()">
                                    <i class="fas fa-eye"></i>
                                </span>
                                <?php if (isset($errors['mdp'])) echo '<span class="text-danger">' . $errors['mdp'] . '</span>'; ?>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-dark w-100">S'inscrire</button>

                </form>
            </div>
        </div>
    </section>
</main>


    </main>

    <script src="../js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>