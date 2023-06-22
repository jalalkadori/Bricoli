<?php 
    include("../db_connection.php");
    include("session-config.php");

    // Check if the message and alert class are set in the session
    if (isset($_SESSION['message']) && isset($_SESSION['alertClass'])) {
        // Retrieve the message and alert class
        $message = $_SESSION['deleteMessage'];
        $alertClass = $_SESSION['alertClass'];

        // Clear the session variables
        unset($_SESSION['deleteMessage']);
        unset($_SESSION['alertClass']);
    }
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
                <a class="navbar-brand" href="./dashboard">
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
                            <a class="nav-link" href="./blog">Articles de blog</a>
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

        <section class="container my-3" id="blogGallery">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="image-heading">
                    <h2 class="fs-1 fw-bold">BRICO</h2>
                    <img src="../images/blog/blog.png" alt="Description of the image" width="100" height="" class="svg-image">
                </div>
                <a type="button" class="btn text-dark" href="./nv-article">+ Ajouter un article</a>
            </div>
            <!-- Display the deletion result message using Bootstrap alert -->
            <?php if (isset($message) && isset($alertClass)): ?>
                <div class="alert <?php echo $alertClass; ?> mt-3" role="alert">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <div class="row row-cols-1 row-cols-lg-3 text-center">
            <?php
                // Fetch articles from the database
                $stmt = $db_connection->prepare("SELECT * FROM article");
                $stmt->execute();
                $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Display articles
                foreach ($articles as $article) {
                    $imgUrl = $article['img_url'];
                    $category = $article['categorie_acticle'];
                    $title = $article['titre_article'];
                    $updatedAt = date("d F Y", strtotime($article['date_publication'])); // Format the date as "day month year"
                    $articleId = $article['id_Article'];
                    $encodedTitle = urlencode($title); // URL encode the article title

                     // Define an array of personalized button colors
                    $buttonColors = array(
                        "Peinture" => "btn-primary",
                        "Plomberie" => "btn-secondary",
                        "Electricité" => "btn-danger",
                        "Carrelage" => "btn-success",
                        "Electroménager" => "btn-warning",
                        "Montage de meubles" => "btn-dark"
                    );
                    // Determine the button color based on the category
                    $buttonColor = isset($buttonColors[$category]) ? $buttonColors[$category] : "btn-primary";

                    // HTML code for displaying the article
                    echo '<div class="col mb-2">';
                    echo '        <div class="card border-0 text-white rounded h-100">';
                    echo '            <img class="card-img img-fluid h-100" src="' . $imgUrl . '" alt="Article image">';
                    echo '            <div class="card-img-overlay d-flex flex-column justify-content-end align-items-end p-0">';
                    echo '                <div class="text-end w-100">';
                    echo '                    <span class="btn ' . $buttonColor . ' rounded-0">' . $category . '</span>';
                    echo '                </div>';
                    echo '                <div class="text-start w-100 px-2 py-1 bg-dark" style="--bs-bg-opacity: .5;">';
                    echo '                    <h5 class="card-title">' . $title . '</h5>';
                    echo '                    <div class="d-flex justify-content-between align-items-center">';
                    echo '                        <small class="text-white p-0">Dernière mise à jour ' . $updatedAt . '</small>';
                    echo '                        <a href="articles?id=' . $articleId . '&title=' . urlencode($title) . '" class="btn text-warning border-0" >Lire la suite ></a>';
                    echo '                    </div>';
                    echo '                </div>';
                    echo '            </div>';
                    echo '        </div>';
                    echo '</div>';
                }
            ?>


            </div>
        </section>
        

    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>