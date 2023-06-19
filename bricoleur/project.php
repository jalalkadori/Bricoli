<?php 
    include("../db_connection.php");
    include("./session-config.php");
    $Id_bricoleur = $_SESSION['bricoleurID'];
    // get project id from url
    $projectId = $_GET['id'];  
    // get project data from database
    $stmt = $db_connection->prepare("SELECT * FROM `realisations` WHERE id_realisation = ?");
    $stmt->execute([$projectId]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the bricoleurID exists in the database
    if ($row) {
        // Extract the values from the fetched row
        // Extract the values from the fetched row
        $titre = $row['titre_realisation'];
        $description = $row['description_realisation'];
        $imgUrl = $row['img_realisation'];;
        $date_realisation = date("d F Y", strtotime($row['date_realisation'])); // Format the date as "day month year"
    } else {
        // Handle the case when the bricoleurID does not exist in the database
        // For example, display an error message or redirect to an error page
        echo "Aucun projet trouvé.";
        exit;
    }
    
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bricoli | Inscription</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/bricoleur-style.css">
    <script src="https://kit.fontawesome.com/75c6b1327b.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>
    <header class="container-fluid bg-light sticky-top">
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


    <main>

        <section class="container my-3 border border-dark bg-white rounded" id="projet">
            <div class="px-5 mt-3 d-flex justify-content-between align-items-center">
                <h3 class="fw-bolder"><?php echo $titre ?></h3>
                <div class="d-flex justify-content-between align-items-center">
                    <small><i class="fa-solid fa-star text-yellow"></i> 4,5</small>
                </div>
            </div>
            <hr class="border border-warning border-2 opacity-25">

            <div class="d-flex justify-content-center my-5">
                <div class="col-10 mb-3">
                    <?php
                    echo '
                        <div class="card rounded-0" style="background-image: url(\'' . $imgUrl . '\');"></div>
                        <div class="d-flex justify-content-between align-items-center bg-dark px-2">
                            <small class="text-white">Publié le ' . $date_realisation . '</small>
                            <a href="#" class="btn btn-link text-light text-decoration-none hover-yellow">
                                <small>Lire La suite -></small>
                            </a>
                        </div>
                        <p class="my-3">' . $description . '</p>
                        <a href="profil" class="btn btn-outline-dark"><i class="fa-solid fa-arrow-left"></i> Retour</a>
                    '
                    ?>
                </div>
            </div>
        </section>
    </main>


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>