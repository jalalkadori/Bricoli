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
        // Include your database connection code here

        // Define the necessary variables
        $titre = "";
        $description = "";
        $image = "";
        $id_bricoleur = "";
        $errorMessage = "";

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve and sanitize input data
            $titre = sanitizeInput($_POST['titre']);
            $description = sanitizeInput($_POST['description']);
            $image = $_FILES['image']['name'];
            $id_bricoleur = sanitizeInput($_POST['id_bricoleur']);

            // Validate the input fields
            if (empty($titre) || empty($description) || empty($image) || empty($id_bricoleur)) {
                $errorMessage = "Veuillez remplir tous les champs.";
            } else {
                // Upload the image file
                $targetDirectory = "uploads/";
                $targetFilePath = $targetDirectory . basename($image);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

                // Check if the image file is a valid image
                $check = getimagesize($_FILES['image']['tmp_name']);
                if ($check === false) {
                    $errorMessage = "Le fichier sélectionné n'est pas une image.";
                    $uploadOk = 0;
                }

                // Check if the file already exists
                if (file_exists($targetFilePath)) {
                    $errorMessage = "Le fichier existe déjà.";
                    $uploadOk = 0;
                }

                // Check file size (limit to 5MB)
                if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
                    $errorMessage = "La taille du fichier est trop grande. Veuillez sélectionner un fichier inférieur à 5 Mo.";
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
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                        // Insert the project details into the database
                        $stmt = $db_connection->prepare("INSERT INTO realisation (titre_realisation, description_realisation, img_realisation, id_bricoleur) VALUES (:titre, :description, :image, :id_bricoleur)");
                        $stmt->bindParam(':titre', $titre);
                        $stmt->bindParam(':description', $description);
                        $stmt->bindParam(':image', $targetFilePath);
                        $stmt->bindParam(':id_bricoleur', $id_bricoleur);

                        if ($stmt->execute()) {
                            // Project added successfully
                            $successMessage = "Le projet a été ajouté avec succès.";
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
                <img src="<" class="w-50 img-fluid rounded-circle" alt="Image de profil" style="margin: 0 auto;">
            </div>

            <div class="col-12 col-lg-8 d-flex flex-column justify-content-center border rounded ">
                <h2 class="pt-2">Ajouter un nouveau projet</h2>
                <hr class="border border-warning border-2 opacity-25">
                
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre :</label>
                        <input type="text" class="form-control" id="titre" name="titre" value="<?php echo $titre; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description :</label>
                        <textarea class="form-control" id="description" name="description"><?php echo $description; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image :</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <div class="mb-3">
                        <label for="id_bricoleur" class="form-label">ID Bricoleur :</label>
                        <input type="text" class="form-control" id="id_bricoleur" name="id_bricoleur" value="<?php echo $id_bricoleur; ?>">
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end py-2">
                        <a href="profil" class="btn btn-danger">Annuler</a>
                        <button type="submit" class="btn btn-primary">Ajouter le projet</button>
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