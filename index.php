<?php 
    include("./db_connection.php");

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bricoli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/style.css">
    <script src="https://kit.fontawesome.com/75c6b1327b.js" crossorigin="anonymous"></script>
</head>
  <body>
    <header class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-body-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="./index.php">
                    <img src="./logo/logo1500.png" alt="bricoli logo" srcset="bricoli logo" width="200">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse fw-semibold text-uppercase" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#blog">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contactez-Nous</a> 
                        </li>
                    </ul>
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Se connecter <i class="fa-solid fa-right-to-bracket"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Bricoleur</a></li>
                                <li><a class="dropdown-item" href="#">Chercheur</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./bricoleur/signup.php">Devenir Bricoleur</a>
                        </li>
                    </ul>
                    
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section class="container-fluid slide py-5" id="slide">
            <div class="d-flex flex-column justify-centent-end align-items-center py-5">
                <h1 class="py-3">Besoin d'aide ?</h1>
                <h2 class="py-3">Trouvez un bricoleur proche de chez vous</h2>
                <a href="#services" class="btn btn-light slide-btn">Trouver un bricoleur</a>
            </div>
        </section>

        <section class="container-fluid py-5 light-background" id="bricoleurDuMoi">
            <div class="container">
                <h2 class="py-3">Bricoleurs du mois de Mai</h2>
                <div class="row row-cols-lg-3">
                    <?php
                        for ($x = 0; $x < 3; $x++) {
                            echo '
                                <div class="col">
                                    <div class="card border border-0 bg-transparent">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                <img src="./images/peinture.jpg" alt="Card Image" class="img-fluid">
                                            </div>
                                            <div class="col-md-8 ">
                                                <div class="card-body ">
                                                    <h5 class="card-title">bricoleur Nom</h5>
                                                    <h6 class="card-title">rating</h6>
                                                    <p class="card-text text-center">Description</p>
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

        <section class="container my-5" id="services">
            <div class="d-flex flex-column align-items-center">
                <h3>Je recherche un bricoleur</h3>
                <h2 class="my-4">Quel type de services recherchez-vous ?</h2>
                <div class="row row-cols-lg-3 my-3">
                    <?php
                    $category = array(
                        array(
                                "img" => "peinture.jpg",
                                "color" => "btn-primary",
                                "category" => "Peinture"
                            ),
                            array(
                                "img" => "Plomberie.jpg",
                                "color" => "btn-secondary",
                                "category" => "Plomberie"
                            ),
                            array(
                                "img" => "Electricité.jpg",
                                "color" => "btn-danger",
                                "category" => "Electricité"
                            ),
                            array(
                                "img" => "Carrelage.jpg",
                                "color" => "btn-success",
                                "category" => "Carrelage"
                            ),
                            array(
                                "img" => "Electroménager.jpg",
                                "color" => "btn-warning",
                                "category" => "Electroménager"
                            ),
                            array(
                                "img" => "Motage de meubles.jpg",
                                "color" => "btn-dark",
                                "category" => "Motage de meubles"
                            )
                        );

                    for ($x = 0; $x < count($category); $x++) {
                        $imgSrc = $category[$x]['img'];
                        $buttonColor = $category[$x]['color'];
                        $categoryName = $category[$x]['category'];
                    
                        echo '
                            <div class="col mb-3 d-flex justify-content-center">
                                <div class="card card3 border-0 card-hover-scale">
                                    <div class="d-flex flex-column align-items-center gap-4">
                                        <img src="./images/' . $imgSrc . '" class="card-img-top" alt="Image">
                                    </div>
                                    <div class="overlay">
                                        <button class="btn ' . $buttonColor . '">' . $categoryName . '</button>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                    ?>
                </div>
            </div>
        </section>

        <section class="container-fluid my-5 light-background" id="procedures">
            <div class="container d-flex flex-column align-items-center py-5">
                <h3>Comment ça marche ?</h3>
                <h2 class="my-4">Pour tous vos petits travaux, il y a BRICOLI</h2>
                <div class="row row-cols-lg-4 my-5">
                <?php
                    $procedure = [
                        [
                            "text" => "Sélectionnez votre besoin parmi les catégories",
                            "imgUrl" => "list.svg"
                        ],
                        [
                            "text" => "Découvrez les profils des différents Bricoco de votre périmètre",
                            "imgUrl" => "profiling.svg"
                        ],
                        [
                            "text" => "Nous vous mettons en contact avec votre Bricoco préféré",
                            "imgUrl" => "messaging.svg"
                        ],
                        [
                            "text" => "Une fois le travail réalisé, vous payez le Bricoco directement, sans frais supplémentaires",
                            "imgUrl" => "payment.png"
                        ]
                    ];

                    foreach ($procedure as $item) {
                        $text = $item['text'];
                        $imgUrl = $item['imgUrl'];
                        ?>
                        <div class="col mb-3">
                            <div class="card border-0 bg-transparent">
                                <div class="card-body d-flex flex-column align-items-center gap-4">
                                    <img src="./images/procedure/<?= $imgUrl ?>" class="card-img-top" alt="...">
                                    <p class="card-title"><?= $text ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                ?>

                </div>
            </div>
        </section>

        <section class="container-fluid" id="bricoProcedure">
            <div class="container d-flex flex-column align-items-center">
                <h3>Devenez Bricoli</h3>
                <h2 class="text-warning fs-1 fw-bold my-4">Passionné ou professionnel,</h2>
                <h2>rejoignez le réseau <span class="text-warning fw-bold fs-1">Bricoli</span>  et arrondissez vos fins de mois</h2>
                <div class="row row-cols-lg-3 my-5">
                <?php
                    $bricoProcedure = [
                        [
                            "text" => "Complétez votre profil bricoli en quelques clics, fixez un tarif à l’heure",
                            "imgUrl" => "profil.svg"
                        ],  
                        [
                            "text" => "Un particulier proche de chez vous vous contacte pour une mission",
                            "imgUrl" => "messaging.svg"
                        ],
                        [
                            "text" => "Une fois la tâche accomplie, vous êtes payé en direct !",
                            "imgUrl" => "payement.svg"
                        ],
                    ];

                    foreach ($bricoProcedure as $item) {
                        $text = $item['text'];
                        $imgUrl = $item['imgUrl'];
                        ?>
                        <div class="col mb-3">
                            <div class="card border-0">
                                <div class="card-body d-flex flex-column align-items-center gap-4">
                                    <img src="./images/bricoprocedure/<?= $imgUrl ?>" class="card-img-top w-50" alt="...">
                                    <p class="card-title"><?= $text ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                ?>

                </div>
                <button class="btn btn-dark">Je m'inscrit</button>
            </div>
        </section>

        <section class="container-fluid py-5" id="blog">
            <div class="container">

                <div class="image-heading">
                    <h2 class="fs-1 fw-bold">BRICO</h2>
                    <img src="./images/blog/blog.png" alt="Description of the image" width="100" height="" class="svg-image">
                </div>

                <div id="carousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="./images/slide.jpg" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>First slide label</h5>
                                <p>Some representative placeholder content for the first slide.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="./images/slide.jpg" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Second slide label</h5>
                                <p>Some representative placeholder content for the second slide.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="./images/slide.jpg" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Third slide label</h5>
                                <p>Some representative placeholder content for the third slide.</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div class="text-end my-2">
                    <a class="text-end  fs-6">Voir tous les articles <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </section>

       
    </main>

    <footer class="container-fluid bg-dark py-5">
        <div class="container">
                <a class="navbar-brand" href="./index.php">
                    <img src="./logo/BRICO-WHITE.png" alt="bricoli logo" srcset="bricoli logo" width="200">
                </a>
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
                        <h5 class="text-warning py-3">Utiliser Bricoli</h5>
                        <p class="text-light">Devenir Bricocoleur</p>
                        <p class="text-light">Travaux entre particuliers</p>
                    </div>
                </div>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>