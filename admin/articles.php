<?php 
    include("../db_connection.php");
    include("session-config.php");
    // Retrieve the article ID from the URL
    $articleId = $_GET['id'];
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

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-center mt-5">Détails de l'article</h1>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <a href="blog" class="btn btn-outline-dark"><i class="fa-solid fa-arrow-left"></i> Retour</a>
                            <div>
                                <a href="edit-article?id=<?php echo $articleId; ?>" class="btn"><i class="fa-solid fa-pen-to-square"></i> Modifier</a>
                                <a class="btn" data-bs-toggle="modal" data-bs-target="#deletModal"><i class="fa-solid fa-trash"></i> Supprimer</a>
                            </div>

                        </div>
                        <?php
                            
                            // Check if the article ID is present in the URL
                            if (isset($_GET['id'])) {
                                

                                // Prepare the SELECT statement to fetch the article data
                                $stmt = $db_connection->prepare("SELECT * FROM article WHERE id_Article = :articleId");
                                $stmt->bindParam(':articleId', $articleId);
                                $stmt->execute();

                                // Fetch the article data
                                $article = $stmt->fetch(PDO::FETCH_ASSOC);

                                // Check if the article exists
                                if ($article) {
                                    $imgUrl = $article['img_url'];
                                    $category = $article['categorie_acticle'];
                                    $title = $article['titre_article'];
                                    $updateDate = date("d F Y", strtotime($article['date_publication'])); // Format the date as "day month year"
                                    $articleContent = $article['corp_article'];

                                    // HTML code for displaying the article details
                                    echo '<div class="card">';
                                    echo '    <img src="' . $imgUrl . '" class="card-img-top" alt="Article image">';
                                    echo '    <div class="card-body">';
                                    echo '        <h5 class="card-title">' . $title . '</h5>';
                                    echo '        <p class="card-text">' . $articleContent . '</p>';
                                    echo '        <p class="card-text">Dernière mise à jour : ' . $updateDate . '</p>';
                                    echo '        <a href="blog" class="btn btn-outline-dark"><i class="fa-solid fa-arrow-left"></i> Retour</a>';
                                    echo '    </div>';
                                    echo '</div>';
                                } else {
                                    // Article not found
                                    echo '<p>Aucun article trouvé.</p>';
                                }
                            } else {
                                // No article ID in the URL
                                echo '<p>Aucun identifiant d\'article spécifié.</p>';
                            }
                        ?>
                    </div>
                </div>

                <!-- deleting article Modal window -->
                <div class="modal fade" id="deletModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirmation de suppression</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Êtes-vous sûr de vouloir supprimer cet article ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <a href="delete-article?id=<?php echo $articleId; ?>" type="button" class="btn btn-danger">Supprimer</a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        


       

    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>