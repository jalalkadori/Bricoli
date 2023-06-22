<?php
include("../db_connection.php");
include("./session-config.php");
$category = $Id_bricoleur = "";
// Retrieve the category variable from the URL
if (isset($_GET['id'])) {
    $Id_bricoleur = $_GET['id'];
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bricoli</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/bricoleur-style.css">
    <script src="https://kit.fontawesome.com/75c6b1327b.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
 </head>
  <body>
    
    <main>
        
        <section class="serviceSlide" id="serviceSlide">
            <?php
                // include the header code
                include("../components/headerPages.php");
            ?>
        </section>

        <section class="container my-3 border border-dark bg-white rounded" id="profil">
            <div class="container">
                <?php
                    $nom = $prenom = $cin = $ville = $email = $telephone = $imgUrl = $speciality = "";
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
                    }
                ?>


                <div class="px-5 mt-3 d-flex flex-column flex-sm-row justify-content-between align-items-center">
                    <h3 class="fw-bolder text-center text-sm-start my-2">Information personnelles</h3>
                    <a href="https://wa.me/+212601949570" class="whatsapp-button" target="_blank">
                        <i class="fa-brands fa-whatsapp fs-2"></i>
                        <span class="whatsapp-number"><?php echo $telephone ?></span>
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
                        <p><i class="fa-solid fa-phone"></i> <?php echo $telephone; ?></p>
                        
                    </div>
                </div>
            </div>
        </section>
        
        <section class="container my-3 border border-dark bg-white rounded" id="realisation">
            <div class="px-5 mt-3 d-flex justify-content-between align-items-center">
                <h3 class="fw-bolder">Projets réalisés</h3>
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
                        // when there are no projects for the given bricoleur ID
                        echo "Aucune réalisation trouvée";
                        exit;
                    }
                ?>
            </div>
        </section>

        




 
    </main> 

    <footer class="container-fluid bg-dark py-5">
        <div class="container">
                <a class="navbar-brand" href="../index.php">
                    <img src="../logo/BRICO-WHITE" alt="bricoli logo" srcset="bricoli logo" width="200">
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
