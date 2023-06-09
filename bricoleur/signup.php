<?php 
    include("../db_connection.php");
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
    <header class="container-fluid bg-light fixed-top">
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
                        <li class="nav-item">
                            <a class="nav-link" href="login">Se Connecter <i class="fa-solid fa-right-to-bracket"></i></a> 
                        </li>
                    </ul>
                    
                </div>
            </div>
        </nav>
    </header>


    <main>
        <section class="container justify-centent-center align-items-center mt-5 py-5 vh-75 ">
            
            <div class="row py-5 bg-light">
                <div class="col-4"></div>
                <div class="col-8">
                    <h2>Créez votre compte BRICOLI</h2>
                    <form>
                        <div class="mb-3">
                            <label for="nom_bricoleur" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom_bricoleur" name="nom_bricoleur">
                        </div>
                        <div class="mb-3">
                            <label for="prenom_bricoleur" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="prenom_bricoleur" name="prenom_bricoleur">
                        </div>
                        <div class="mb-3">
                            <label for="tele_bricoleur" class="form-label">Téléphone</label>
                            <input type="text" class="form-control" id="tele_bricoleur" name="tele_bricoleur">
                        </div>
                        <div class="mb-3">
                            <label for="cin_bricoleur" class="form-label">CIN</label>
                            <input type="text" class="form-control" id="cin_bricoleur" name="cin_bricoleur">
                        </div>
                        <div class="mb-3">
                            <label for="adresse_bricoleur" class="form-label">Adresse</label>
                            <input type="text" class="form-control" id="adresse_bricoleur" name="adresse_bricoleur">
                        </div>
                        <div class="mb-3">
                            <label for="ville_bricoleur" class="form-label">Ville</label>
                            <input type="text" class="form-control" id="ville_bricoleur" name="ville_bricoleur">
                        </div>
                        <div class="mb-3">
                            <label for="img_profile" class="form-label">Image de profil</label>
                            <input type="file" class="form-control" id="img_profile" name="img_profile">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="mdp_bricoleur" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="mdp_bricoleur" name="mdp_bricoleur">
                        </div>
                        <button type="submit" class="btn btn-dark w-100">Submit</button>
                    </form>

                </div>
            </div>

        </section>

    </main>

    <footer class="container-fluid bg-dark">
        
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>