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
                            <a class="nav-link" href="../index.php">Home</a> 
                        </li>
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
        <div class="container my-3">
            <h2 class="fw-bold">Mon Profile</h2>
        </div>
        <section class="container my-3 border border-dark bg-white rounded" id="profil">
            <div class="container ">
                <?php

                    // Check if the 'success' key is set in the $_GET array
                    if (isset($_GET['success'])) {
                        $successMessage = $_GET['success'];
                    }

                    $stmt = $db_connection->prepare("SELECT * FROM `bricoleur` WHERE id_bricoleur = ?");
                    $stmt->execute([$Id_bricoleur]);
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Check if the bricoleurID exists in the database
                    if ($row) {
                        // Extract the values from the fetched row
                        $nom = $row['nom_bricoleur'];
                        $prenom = $row['prenom_bricoleur'];
                        $cin = $row['cin_bricoleur'];
                        $ville = $row['ville_bricoleur'];
                        $email = $row['email'];
                        $telephone = $row['tele_bricoleur'];
                        $imgUrl = $row['img_profile'];
                        $speciality = $row['speciality'];
                    } else {
                        // Handle the case when the bricoleurID does not exist in the database
                        // For example, display an error message or redirect to an error page
                        echo "Bricoleur ID not found in the database";
                        exit;
                    }
                ?>


                <div class="px-5 mt-3 d-flex justify-content-between align-items-center">
                    <h3 class="fw-bolder">Mon compte</h3>
                    <a href="edit-profil.php" class="btn fw-bolder hover-yellow" data-bs-toggle="tooltip" data-bs-placement="top" title="Your tooltip message">
                        <i class="fa-solid fa-pen-to-square fs-4"></i> Modifier
                    </a>
                </div>

                <hr class="border border-warning border-2 opacity-25">
                
                <div class="row flex-column flex-sm-row text-center align-items-center text-sm-start">
                    <div class="col mb-3">
                        <img src="<?php echo $imgUrl; ?>" class="w-50 rounded-circle" width="100">
                    </div>
                    <div class="col mb-3">
                        <h5 class="fw-bolder"><?php echo $nom .' '. $prenom; ?></h5>
                        <p><i class="fa-solid fa-id-card"></i> <?php echo $cin; ?></p>
                        <p><i class="fa-solid fa-location-dot"></i> <?php echo $ville; ?></p>
                    </div>
                    <div class="col mb-3">
                        <h5 class="fw-bolder">Contact</h5>
                        <p><i class="fa-solid fa-envelope"></i> <?php echo $email; ?> </p>
                        <p><i class="fa-solid fa-phone"></i> <?php echo $telephone; ?><?php echo $_SESSION['bricoleurID']; ?></p>
                        
                    </div>
                </div>
            </div>
        </section>

        <section class="container my-3 border border-dark bg-white rounded" id="realisation">
            <div class="px-5 mt-3 d-flex justify-content-between align-items-center">
                <h3 class="fw-bolder">Mes réalisations</h3>
                <a href="add-project.php" class="btn fw-bolder hover-yellow align" data-bs-toggle="tooltip" data-bs-placement="top" title="Your tooltip message">
                    <i class="fa-solid fa-plus fs-4"></i> Ajouter
                </a>
            </div>
            <hr class="border border-warning border-2 opacity-25">

            <!-- in case of an added project Display the success -->
            <?php if (!empty($successMessage)) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $successMessage; ?>
                </div>
            <?php endif; ?>

            <div class="row row-cols-1 row-cols-lg-3 my-5">
                <?php
                    $stmt = $db_connection->prepare("SELECT * FROM `realisations` WHERE id_bricoleur = ?");
                    $stmt->execute([$Id_bricoleur]);
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Check if there are any projects for the given bricoleur ID
                    if ($rows) {
                        foreach ($rows as $row) {
                            // Extract the values from the fetched row
                            $projectId = $row['id_realisation'];
                            $titre = $row['titre_realisation'];
                            $description = $row['description_realisation'];
                            $imgUrl = $row['img_realisation'];;
                            $date_realisation = date("d F Y", strtotime($row['date_realisation'])); // Format the date as "day month year"
                            
                            echo '
                                <div class="col mb-3">
                                    <div class="card shadow" style="background-image: url(\'' . $imgUrl . '\');">
                                        <div class="card-img-overlay">
                                            <div class="overlay-content d-flex flex-column justify-content-between text-light h-100">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small><i class="fa-solid fa-star text-yellow"></i> 4,5</small>
                                                    <button class="btn btn-warning rounded-0">' . $speciality . '</button>
                                                </div>
                                                <div class="d-flex flex-column justify-content-between project-title p-2">
                                                    <h4 class="card-title">' . $titre . '</h4>
                                                    <div class="d-flex justify-content-between align-items-center bg-dark px-2">
                                                        <small class="text-white">Publié le ' . $date_realisation . '</small>
                                                        <a href="project?id=' . $projectId . '&title=' . urlencode($titre) . '" class="btn btn-link text-light text-decoration-none hover-yellow">
                                                            <small>Lire La suite -></small>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ';

                        }
                    } else {
                        // Handle the case when there are no projects for the given bricoleur ID
                        // For example, display an error message or redirect to an error page
                        echo "Aucune réalisation trouvée";
                        exit;
                    }
                ?>
            </div>
        </section>
    </main>


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>