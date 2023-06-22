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
        
        <section class="slide" id="slide">
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

        <section class="container my-5" id="blogGallery">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="image-heading">
                    <h2 class="fs-1 fw-bold">BRICO</h2>
                    <img src="./images/blog/blog.png" alt="Description of the image" width="100" height="" class="svg-image">
                </div>
            </div>
            <!-- Display the deletion result message using Bootstrap alert -->
            <?php if (isset($message) && isset($alertClass)): ?>
                <div class="alert <?php echo $alertClass; ?> mt-3" role="alert">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <div class="row row-cols-1 row-cols-lg-3 text-center">
            <?php
                // Fetch articles from the database
                $stmt = $db_connection->prepare("SELECT * FROM article");
                $stmt->execute();
                $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Display articles
                foreach ($articles as $article) {
                    $imgUrl = $article['img_url'];
                    $category = $article['categorie_acticle'];
                    $title = $article['titre_article'];
                    $updatedAt = date("d F Y", strtotime($article['date_publication'])); // Format the date as "day month year"
                    $articleId = $article['id_Article'];
                    $encodedTitle = urlencode($title); // URL encode the article title

                     // Define an array of personalized button colors
                    $buttonColors = array(
                        "Peinture" => "btn-primary",
                        "Plomberie" => "btn-secondary",
                        "Electricité" => "btn-danger",
                        "Carrelage" => "btn-success",
                        "Electroménager" => "btn-warning",
                        "Montage de meubles" => "btn-dark"
                    );
                    // Determine the button color based on the category
                    $buttonColor = isset($buttonColors[$category]) ? $buttonColors[$category] : "btn-primary";

                    // HTML code for displaying the article
                    echo '<div class="col mb-2">';
                    echo '        <div class="card border-0 text-white rounded h-100">';
                    echo '            <img class="card-img img-fluid h-100" src="./images/peinture.jpg" alt="Article image">';
                    echo '            <div class="card-img-overlay d-flex flex-column justify-content-end align-items-end p-0">';
                    echo '                <div class="text-end w-100">';
                    echo '                    <span class="btn ' . $buttonColor . ' rounded-0">' . $category . '</span>';
                    echo '                </div>';
                    echo '                <div class="text-start w-100 px-2 py-1 bg-dark" style="--bs-bg-opacity: .5;">';
                    echo '                    <h5 class="card-title">' . $title . '</h5>';
                    echo '                    <div class="d-flex justify-content-between align-items-center">';
                    echo '                        <small class="text-white p-0">Dernière mise à jour ' . $updatedAt . '</small>';
                    echo '                        <a href="articles?id=' . $articleId . '&title=' . urlencode($title) . '" class="btn text-warning border-0" >Lire la suite ></a>';
                    echo '                    </div>';
                    echo '                </div>';
                    echo '            </div>';
                    echo '        </div>';
                    echo '</div>';
                }
            ?>


            </div>
        </section>

       
    </main> 

    <!-- include the footer code -->
    <?php include_once './components/footer.php' ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>