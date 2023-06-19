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
 
  <?php

        // Define the necessary variables
        $titre = "";
        $description = "";
        $image = "";
        $errorMessages = array();

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve and sanitize input data
            $titre = sanitizeInput($_POST['titre']);
            $description = sanitizeInput($_POST['description']);
            $image = $_FILES['image']['name'];

            // Validate the input fields
            if (empty($titre)) {
                $errorMessages['titre'] = "Veuillez saisir un titre.";
            }
            if (empty($description)) {
                $errorMessages['description'] = "Veuillez saisir une description.";
            }
            if (empty($image)) {
                $errorMessages['image'] = "Veuillez sélectionner une image.";
            }


            if (count($errorMessages) === 0) {
                // Upload the image file
                $targetDirectory = "../images/bricoleur/realisations/";
                $imageName = $_FILES['image']['name'];
                $imageTmpName = $_FILES['image']['tmp_name'];

                // Get the file extension
                $imageFileType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

                // Generate a unique ID
                $uniqueID = uniqid();

                // Create the target file path with the unique ID
                $targetFilePath = $targetDirectory . $uniqueID . '.' . $imageFileType;

                $uploadOk = 1;

                // Check if the image file is a valid image
                $check = getimagesize($imageTmpName);
                if ($check === false) {
                    $errorMessage = "Le fichier sélectionné n'est pas une image.";
                    $uploadOk = 0;
                }

                // Check if the file already exists
                if (file_exists($targetFilePath)) {
                    $errorMessage = "Le fichier existe déjà.";
                    $uploadOk = 0;
                }

                // Check file size (limit to 2MB)
                if ($_FILES['image']['size'] > 2 * 1024 * 1024) {
                    $errorMessage = "La taille du fichier est trop grande. Veuillez sélectionner un fichier inférieur à 2 Mo.";
                    $uploadOk = 0;
                }

                // Allow only specific file formats (you can add more formats if needed)
                $allowedFormats = array("jpg", "jpeg", "png");
                if (!in_array($imageFileType, $allowedFormats)) {
                    $errorMessage = "Seuls les fichiers JPG, JPEG et PNG sont autorisés.";
                    $uploadOk = 0;
                }

                // If all checks pass, move the file to the target directory
                if ($uploadOk) {
                    if (move_uploaded_file($imageTmpName, $targetFilePath)) {
                        // Insert the project details into the database
                        $stmt = $db_connection->prepare("INSERT INTO realisations (id_realisation, titre_realisation, description_realisation, img_realisation, id_bricoleur) VALUES (Null, :titre, :description, :image, :id_bricoleur)");
                        $stmt->bindParam(':titre', $titre);
                        $stmt->bindParam(':description', $description);
                        $stmt->bindParam(':image', $targetFilePath);
                        $stmt->bindParam(':id_bricoleur', $Id_bricoleur);

                        if ($stmt->execute()) {
                            // Project added successfully
                            $successMessage = "Le projet a été ajouté avec succès.";
                            // Redirect to the login page with the success message in the URL
                            header("Location: profil.php?success=" . urlencode($successMessage));
                            exit;
                        } else {
                            $errorMessage = "Erreur lors de l'ajout du projet. Veuillez réessayer.";
                        }
                    } else {
                        $errorMessage = "Erreur lors de l'upload du fichier. Veuillez réessayer.";
                    }
                }
            }
        }

        // Function to sanitize input
        function sanitizeInput($input)
        {
            $input = trim($input);
            $input = htmlspecialchars($input);
            return $input;
        }
    ?>


<main class="osition-relative vh-100">
    <header class="container-fluid bg-white sticky-top">
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
                                <li><a class="dropdown-item" href="profil">Mon Profile</a></li>
                                <li><a class="dropdown-item" href="logout">Déconnexion</a></li>
                            </ul>
                        </li>
                    </ul>
                    
                </div>
            </div>
        </nav>
    </header>
    <section class="container center-content border rounded container-shadow my-5 my-md-0 my-lg-0">
        <div class="row bg-white">
            <div class="col-12 col-lg-4 border d-flex justify-content-center align-items-center d-none d-lg-flex">
                <!-- Existing code for the login illustration -->
            </div>

            <div class="col-12 col-lg-8 d-flex flex-column justify-content-center border rounded ">
                <h2 class="pt-2">Ajouter un nouveau projet</h2>
                <hr class="border border-warning border-2 opacity-25">
                <?php if (isset($errorMessage)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $errorMessage; ?>
                    </div>
                <?php } ?>
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre :</label>
                        <input type="text" class="form-control rounded-0 border-dark" id="titre" name="titre" value="<?php echo $titre; ?>">
                        <?php if (isset($errorMessages['titre'])) { ?>
                            <div class="text-danger"><?php echo $errorMessages['titre']; ?></div>
                        <?php } ?>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description :</label>
                        <textarea class="form-control rounded-0 border-dark" id="description" name="description"><?php echo $description; ?></textarea>
                        <?php if (isset($errorMessages['description'])) { ?>
                            <div class="text-danger"><?php echo $errorMessages['description']; ?></div>
                        <?php } ?>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image :</label>
                        <input type="file" class="form-control rounded-0 border-dark" id="image" name="image">
                        <?php if (isset($errorMessages['image'])) { ?>
                            <div class="text-danger"><?php echo $errorMessages['image']; ?></div>
                        <?php } ?>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end py-2">
                        <a href="profil" class="btn btn-danger rounded-0">Annuler</a>
                        <button type="submit" class="btn btn-success rounded-0">Ajouter le projet</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>


    </main>

    <footer class="container-fluid bg-dark">
        
    </footer>

    <script src="../js/script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>