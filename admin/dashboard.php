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
                                <li><a class="dropdown-item" href="logout">Déconnexion</a></li>
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

        <section class="container my-5">
            <div class="row row-cols-lg-2">
                <?php
                    // Prepare the SQL statement to count the number of articles
                    $stmt = $db_connection->prepare("SELECT COUNT(*) AS articleCount FROM article");
                    // Execute the query
                    $stmt->execute();
                    // Fetch the result
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    // Get the article count from the result
                    $articleCount = $result['articleCount'];       
                ?>
                <?php
                    // Prepare the SQL statement to count the number of articles
                    $stmt = $db_connection->prepare("SELECT COUNT(*) AS bricoleurCount FROM bricoleur");
                    // Execute the query
                    $stmt->execute();
                    // Fetch the result
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    // Get the article count from the result
                    $bricoleurCount = $result['bricoleurCount'];       
                ?>
                <div class="col-12 my-2">
                    <div class="card py-2 h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-2 text-center">
                                    <i class="fa-solid fa-newspaper articleIcon"></i>
                                </div>
                                <div class="col-6 text-start">
                                    <h5 class="fs-2">Articles</h5>
                                    <h6>Nombre total d'articles publiés</h6>
                                </div>
                                <div class="col-4 d-flex justify-content-end align-items-center">
                                    <h2 class="fs-1"><?php echo $articleCount;?> <i class="fa-solid fa-arrow-trend-up"></i></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 my-2">
                    <div class="card py-2">
                        <div class="card-body h-100">
                            <div class="row align-items-center">
                                <div class="col-2 text-center">
                                <i class="fa-solid fa-list articleIcon"></i>
                                </div>
                                <div class="col-6 text-start">
                                    <h5 class="fs-2">Bricoleurs</h5>
                                    <h6>Bricoleurs inscrits</h6>
                                </div>
                                <div class="col-4 text-end">
                                    <h2 class="fs-1"><?php echo $bricoleurCount;?> <span class="material-symbols-outlined"> person_apron</span></h2>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-12 my-2">
                    <div class="card py-2 h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-2 text-center">
                                <i class="fa-solid fa-address-card articleIcon"></i>
                                </div>
                                <div class="col-6 text-start">
                                    <h5 class="fs-2">Inscriptions</h5>
                                    <h6>Inscriptions en attente de validation</h6>
                                </div>
                                <div class="col-4 text-end">
                                    <h2 class="fs-1">0</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 my-2">
                    <div class="card py-2">
                        <div class="card-body h-100">
                            <div class="row align-items-center">
                                <div class="col-2 text-center">
                                <i class="fa-solid fa-circle-exclamation articleIcon"></i>
                                </div>
                                <div class="col-6 text-start">
                                    <h5 class="fs-2">Réclamations</h5>
                                    <h6>Demandes et réclamations à traiter</h6>
                                </div>
                                <div class="col-4 text-end">
                                    <h2 class="fs-1">0</h2>
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