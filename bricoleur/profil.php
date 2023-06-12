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


    <main>
        <section class="container-fluid mt-5">
            <div class="mb-3 text-start py-2 px-5">
                <h2 class="fw-bold">Mon Profil</h2>
            </div>
            <div class="row px-5 gap-5">
            <?php
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
                } else {
                    // Handle the case when the bricoleurID does not exist in the database
                    // For example, display an error message or redirect to an error page
                    echo "Bricoleur ID not found in the database";
                    exit;
                }
            ?>


                <div class="col-12 py-3 border border-dark bg-white rounded px-5" id="profil">
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <h3 class="fw-bolder">Mon compte</h3>
                    <a href="edit-profil.php" class="btn fw-bolder hover-yellow" data-bs-toggle="tooltip" data-bs-placement="top" title="Your tooltip message">
                    <i class="fa-solid fa-pen-to-square fs-2"></i>
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


                <div class="col-12 border border-dark bg-white py-3 rounded">
                    <h2 class="text-center py-3 fw-bolder">Mes projet réalisés</h2>
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4 h-100">
                                <img src="../images/slide2.jpg" class="img-fluid rounded-start h-100" alt="...">
                            </div> 
                            <div class="col-md-8">
                                <div class="card-body d-flex flex-column justify-content-between h-100">
                                    <div class="card-title">
                                        <h2 class="card-title">Titre du projet</h2>
                                    </div>
                                    <div class="card-text">
                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    </div>
                                    <div class="card-footer text-end">
                                        <p class="card-text "><small class="text-body-secondary">Dernière mise à jour (date)</small></p>
                                    </div>
                                </div>
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