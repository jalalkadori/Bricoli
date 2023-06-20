<?php
// Retrieve the category variable from the URL
if (isset($_GET['category'])) {
    $category = $_GET['category'];
    
    // Use the category variable in your code
    // ...
    
    echo "Selected category: " . $category;
}
?>

<?php 
    include("./db_connection.php");
    session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bricoli</title>
    <link rel="stylesheet" href="./styles/style.css">
    <script src="https://kit.fontawesome.com/75c6b1327b.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
 </head>
  <body>
    
    <main>
        
        <section class=" slide" id="slide">
            <?php
                // include the header code
                include("./components/header.php");
            ?>
            <div class="d-flex justify-content-center align-items-end slide-components">
                <div class=" d-flex flex-column justify-content-end align-items-center text-center">    
                    <h1 class="py-3">Besoin d'aide ?</h1>
                    <h2 class="py-3">Trouvez un bricoleur proche de chez vous !</h2>
                    <a href="#services" class="btn rounded-pill">Trouver un bricoleur</a><br>
                </div>
            </div>
        </section>

        <section class="container my-5" id="services">
            <div class="d-flex flex-column align-items-center">
                <h3>Je recherche un bricoleur</h3>
                <h2 class="my-4">Quel type de services recherchez-vous ?</h2>
                <div class="row row-cols-lg-3 my-3">
                    <!-- include the code for the hiring procedure section  -->
                    <?php include_once "./components/services.php"; ?>
                    <!-- with the include_once statement, the code will be included only one time even if the statement is called multiple times -->
                </div>
            </div>
        </section>

        <section class="container-fluid my-5 light-background" id="procedures">
            <div class="container d-flex flex-column align-items-center py-5">
                <h3>Comment ça marche ?</h3>
                <h2 class="my-4">Pour tous vos petits travaux, il y a BRICOLI</h2>
                <div class="row row-cols-1 row-cols-lg-4 my-5">
                    <!-- include the code for the hiring procedure section  -->
                    <?php include_once "./components/procedure.php"; ?>
                </div>
            </div>
        </section>

        <section class="container-fluid" id="bricoProcedure">
            <div class="container d-flex flex-column align-items-center">
                <h3>Devenez Bricoli</h3>
                <h2 class="text-warning fs-1 fw-bold my-4">Passionné ou professionnel,</h2>
                <h2>rejoignez le réseau <span class="text-warning fw-bold fs-1">Bricoli</span>  et arrondissez vos fins de mois</h2>
                <div class="row row-cols-1 row-cols-lg-3 my-5">
                    <!-- include the code for the brico procedure section  -->
                    <?php include_once "./components/bricoProcedure.php"; ?>    
                </div>
                <a href="./bricoleur/signup.php" class="btn btn-dark rounded-pill">Je m'inscrit</a>
            </div>
        </section>

        <section class="container-fluid py-5" id="blog">
            <div class="container">
                <div class="image-heading">
                    <h2 class="fs-1 fw-bold">BRICO</h2>
                    <img src="./images/blog/blog.png" alt="Description of the image" width="100" height="" class="svg-image">
                </div>

                <div id="carousel" class="carousel slide rounded" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner rounded">
                        <div class="carousel-item active">
                            <img src="./images/slide3.jpg" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>First slide label</h5>
                                <p>Some representative placeholder content for the first slide.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="./images/slide3.jpg" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Second slide label</h5>
                                <p>Some representative placeholder content for the second slide.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="./images/slide3.jpg" class="d-block w-100" alt="...">
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

    <!-- include the footer code -->
    <?php include_once './components/footer.php' ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>
