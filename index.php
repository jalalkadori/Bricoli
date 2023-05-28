<?php 
include("./db_connection.php");

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Brikoli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/style.css">
</head>
  <body>
    <header class="container">
        <nav class="navbar navbar-expand-lg bg-body-light">
            <div class="container">
                <a class="navbar-brand" href="./index.php">Bricoli</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        
                    </ul>
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                    
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section class="container-fluid bg-primary slide py-5">
            <div class="container d-flex flex-column justify-centent-end align-items-center py-5">
                <h1 class="py-3">Besoin d'aide ?</h1>
                <h2 class="py-3">Trouvez un bricoleur proche de chez vous</h2>
                <button class="btn btn-light">Trouver un bricoleur</button>
            </div>
        </section>

        <section class="container-fluid py-5 bg-warning-subtle">
            <div class="container">
                <h2 class="py-3">Bricoleurs du mois de <strong>Mai</strong></h2>
                <div class="row row-cols-lg-3">
                    <?php
                        for ($x = 0; $x < 3; $x++) {
                            echo '
                                <div class="col">
                                    <div class="card">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                            <img src="./images/peinture.jpg" alt="Card Image" class="img-fluid">
                                            </div>
                                            <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">bricoleur Nom</h5>
                                                <p class="card-text">Description</p>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }
                    ?>
                </div>
            </div>
        </section>

        <section class="container my-5">
            <div class="d-flex flex-column align-items-center">
                <h3>Je recherche un bricoleur</h3>
                <h2 class="my-4">Quel type de services recherchez-vous ?</h2>
                <div class="row row-cols-lg-3 my-3">
                    <?php
                        for ($x = 0; $x < 6; $x++) {
                            echo '
                                <div class="col mb-3">
                                    <div class="card card3 border-0">
                                        <div class="d-flex flex-column align-items-center gap-4">
                                            <img src="./images/peinture.jpg" class="card-img-top" alt="Image">
                                        </div>
                                        <div class="overlay">
                                            <button class="btn btn-primary">Click Me</button>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }
                    ?>
                </div>
            </div>
        </section>

        <section class="container-fluid my-5 bg-danger-subtle">
            <div class="container d-flex flex-column align-items-center py-5">
                <h3>Comment ça marche ?</h3>
                <h2 class="my-4">Pour tous vos petits travaux, il y a Brikoli</h2>
                <div class="row row-cols-lg-4 my-5">
                    <?php
                        for ($x = 0; $x < 4; $x++) {
                            echo '
                            <div class="col mb-3">
                                <div class="card border-0">
                                    <div class="card-body d-flex flex-column align-items-center gap-4">
                                        <img src="./images/list.svg" class="card-img-top w-50" alt="...">
                                        <h5 class="card-title">Card title</h5>
                                    </div>
                                </div>
                            </div>
                            ';
                        }
                    ?>
                </div>
            </div>
        </section>

        <section class="container-fluid">
            <div class="container d-flex flex-column align-items-center py-5">
                <h3>Devenez Bricoli</h3>
                <h2 class="my-4">Passionné ou professionnel,</h2>
                <h2 class="my-4">rejoignez le réseau Bricoco et arrondissez vos fins de mois</h2>
                <div class="row row-cols-lg-3 my-5">
                    <?php
                        for ($x = 0; $x < 3; $x++) {
                            echo '
                            <div class="col mb-3">
                                <div class="card border-0">
                                    <div class="card-body d-flex flex-column align-items-center gap-4">
                                        <img src="./images/work-done.svg" class="card-img-top" alt="...">
                                        <p class="card-title">Complétez votre profil bricoco en quelques clics, fixez un tarif à l’heure</p>
                                    </div>
                                </div>
                            </div>
                            ';
                        }
                    ?>
                </div>
                <button class="btn btn-dark">Je m'inscrit</button>
            </div>
        </section>

        <section class="container-fluid py-5">
            <div class="container">
                <h2>Brico Blog</h2>
                <div class="row row-cols-lg-2">
                    <div class="col border ">
                        <div class="">
                            <div class="card">
                                <img src="./images/peinture.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col border ">
                        <div class="">
                            <div class="card">
                                <img src="./images/peinture.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="text-end">Voir tous les articles</p>
            </div>
        </section>

       
    </main>

    <footer class="container-fluid bg-dark py-5">
        <div class="container">
            <h2 class="text-warning">BRICOLI</h2>
            <h5 class="text-warning py-3">Trouver un Bricoleur à :</h5>
                <div class="row row-cols-lg-3">
                    <div class="col">
                        <p class="text-light">Casablanca</p>
                        <p class="text-light">Tanger</p>
                        <p class="text-light">Fes</p>
                        <p class="text-light">Merrakech</p>
                    </div>
                    <div class="col">
                        <p class="text-light">Rabat</p>
                        <p class="text-light">Oujda</p>
                    </div>
                </div>

                <div class="row row-cols-lg-3">
                    <div class="col">
                        <h5 class="text-warning py-3">Nous contacter</h5>
                        <p class="text-light">Nous écrire un mot</p>
                    </div>
                    <div class="col">
                        <h5 class="text-warning py-3">À propos:</h5>
                        <p class="text-light">Notre philosophie</p>
                        <p class="text-light">CGU & CGV</p>
                    </div>
                    <div class="col">
                        <h5 class="text-warning py-3">Utiliser Bricoco</h5>
                        <p class="text-light">Devenir Bricocoleur</p>
                        <p class="text-light">Travaux entre particuliers</p>
                    </div>
                </div>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>