<?php 
    include("../db_connection.php");
    include("session-config.php");

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bricoli | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/admin-style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://kit.fontawesome.com/75c6b1327b.js" crossorigin="anonymous"></script>
  </head>
  <body class="bg-pan-right">
    <header class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-body-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="./dashboard.php">
                    <img src="../logo/logo1500.png" alt="bricoli logo" srcset="bricoli logo" width="150">
                </a>

                <!-- Navigation Menu -->
                <div class="justify-content-end">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo $_SESSION['AdminNom']; ?>
                                <i class="fa-sharp fa-solid fa-user fa-sm ml-2"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="logout.php">Déconnexion</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                
            </div>
        </nav>
    </header>
    <main>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container justify-content-end">
                <!-- Burger Button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navigation Menu -->
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="./blog.php">Articles de blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Inscription des bricoleurs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Demande et Réclamations</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <?php
            $idAdmin = $_SESSION['AdminID'];
            $error = "";

            // Function to sanitize and validate input data
            function sanitizeInput($input) {
                // Remove leading and trailing whitespace
                $input = trim($input);
                return $input;
            }

            // Check if the form is submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Retrieve form data and sanitize inputs
                $titre = sanitizeInput($_POST['titre']);
                $categorie = sanitizeInput($_POST['categorie']);
                $articleImg = $_FILES['article-img']['name'];
                $articleImgTmp = $_FILES['article-img']['tmp_name'];
                $articleContenu = sanitizeInput($_POST['article-contenu']);

                // Define the target folder for image uploads
                $targetFolder = "../images/blog/articles/"; // Specify the desired folder path

                // Generate a unique filename for the uploaded image
                $targetFilePath = $targetFolder . uniqid() . '_' . $articleImg;

                // Move the uploaded file to the target folder
                if (move_uploaded_file($articleImgTmp, $targetFilePath)) {
                    // File upload successful, proceed with database insertion
                    // Prepare the INSERT statement
                    // Use parameter binding to prevent SQL injections
                    $stmt = $db_connection->prepare("INSERT INTO article (id_Article, titre_article, corp_article, categorie_acticle, img_url, date_publication, id_admin) VALUES (NULL, :titre, :articleContenu, :categorie, :targetFilePath, CURRENT_TIMESTAMP, :idAdmin)");
                    $stmt->bindParam(':titre', $titre);
                    $stmt->bindParam(':articleContenu', $articleContenu);
                    $stmt->bindParam(':categorie', $categorie);
                    $stmt->bindParam(':targetFilePath', $targetFilePath);
                    $stmt->bindParam(':idAdmin', $idAdmin);

                    // Execute the prepared statement
                    $stmt->execute();

                    // Redirect to a success page or do any other necessary actions
                    header("Location: blog.php");
                    exit();
                } else {
                    // File upload failed
                    $error = "Error uploading the image file.";
                }
            }
            ?>

        <section class="container my-4">
            <h4 class="mb-4">Ajouter un nouvel article</h4>
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="titre" class="form-label">Titre de l'article:</label>
                    <input type="text" class="form-control rounded-0 border border-dark" id="titre" name="titre" required>
                </div>
                <div class="mb-3">
                    <label for="categorie" class="form-label">Catégorie de l'article:</label>
                    
                    <select name="categorie" id="categorie" class="form-select rounded-0 border border-dark" required>
                        <option selected>Choisire une categorie</option>
                        <!-- select option are filled from a json file using javascript -->
                    </select>
                </div>
                <div class="mb-3">
                    <label for="article-img" class="form-label">Image de l'article:</label>
                    <input type="file" class="form-control rounded-0 border border-dark" id="article-img" name="article-img" required accept="image/*">
                    <div class="text-danger">Veuillez noter que la taille maximale des fichiers autorisée est de 2 Mo.</div>
                    <?php if (!empty($error)) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="article-contenu" class="form-label">Contenu de l'article:</label>
                    <textarea class="form-control rounded-0 border border-dark" id="article-contenu" rows="3" name="article-contenu"></textarea>
                </div>
                <button type="submit" class="btn btn-dark rounded-0 w-100">Submit</button>
            </form>
        </section>



        

    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="../js/script.js"></script>
  </body>
</html>