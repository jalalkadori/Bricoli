<?php 
    include("../db_connection.php");
    include("session-config.php");
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
    <header class="container-fluid bg-light">
        <nav class="navbar navbar-expand-lg ">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.php">
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
                    </ul>
                    <ul class="navbar-nav mb-2 mb-lg-0">
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
            <div class="row px-5 justify-content-between gap-3">
                <div class="col-12 col-lg-3 bg-light py-3 border rounded position-sticky">
                    <div class="d-flex flex-lg-column justify-content-center">
                        <div class="mb-3 text-center">
                            <img src="../images/user.jpg" alt="Image" class="w-50 rounded-circle">
                        </div>
                        <div class="mb-3 text-center">
                            <h5>KADDOURI Jalal</h5>
                        </div>
                        <div class="mb-3 text-center">
                            <h5>CIN</h5>
                        </div>
                        <div class="mb-3 text-center">
                            <h5>Adresse Postale</h5>
                        </div>
                        <div class="mb-3 text-center">
                            <h5>0601020304 </h5>
                        </div>
                        <div class="mb-3 text-center">
                            <h5>jalal@gmail.com </h5>
                        </div>
                        <div class="mb-3 text-center">
                            <h5>0601020304</h5>
                        </div>
                        
                    
                    </div>
                </div>

                <div class="col-12 col-lg bg-light py-3 border rounded">
                    <h2 class="text-center py-3">Mes projet réalisés</h2>
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
                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    </div>
                                    <div class="card-footer text-end">
                                        <p class="card-text "><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
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
                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    </div>
                                    <div class="card-footer text-end">
                                        <p class="card-text "><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
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
                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    </div>
                                    <div class="card-footer text-end">
                                        <p class="card-text "><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
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
                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    </div>
                                    <div class="card-footer text-end">
                                        <p class="card-text "><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
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
                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    </div>
                                    <div class="card-footer text-end">
                                        <p class="card-text "><small class="text-body-secondary">Last updated 3 mins ago</small></p>
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