<?php
include("./db_connection.php");
session_start();

// Retrieve the category variable from the URL
if (isset($_GET['category'])) {
    $category = $_GET['category'];
    
    // Retrieve the services from the database
    $sql = "SELECT * FROM service WHERE categorie = '$category'";
    
    
}
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
        
        <section class="container-fluid ">
            <?php
                // include the header code
                include("./components/header.php");
            ?>
            
        </section>

        <section class="container my-5" id="services">
            <div class="d-flex flex-column align-items-center">
                <h3>Je recherche un bricoleur</h3>
                <h2 class="my-4">Quel type de services recherchez-vous ?</h2>
                <div class="row row-cols-lg-3 my-3">
                    
                </div>
            </div>
        </section>
 
    </main> 

    <!-- include the footer code -->
    <?php include_once './components/footer.php' ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>
