<?php
include("../db_connection.php");
session_start();
$category = "";
// Retrieve the category variable from the URL
if (isset($_GET['category'])) {
    $category = $_GET['category'];
}

// Fetch the categories from the JSON file
$villeData = file_get_contents('../json/ville.json');
$villes = json_decode($villeData, true);
?>


    

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bricoli</title>
    <link rel="stylesheet" href="../styles/style.css">
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
            <div class="d-flex justify-content-center align-items-end slide-components">
                <div class="row d-flex flex-column justify-content-end align-items-center text-center">
                    <div class="col">
                        <h1 class="my-4"><?php echo $category; ?></h1>
                    </div>
                </div>
            </div>
        </section>

        <div class="text-center my-5">
            <h3>Je recherche un bricoleur</h3>
            <h2 class="my-4">List des bricoleurs disponible sur la categorie <?php echo $category; ?></h2>
        </div>

        <section id="filter">
            <!-- Adds a filter to search according to bricoleur city -->
            <div class="container">
                <div class="row flex-column align-items-center">
                    <div class="col mb-3">
                        <h5 class="text-center">Filtrer par ville</h5>
                    </div>
                    <div class="col col col-lg-6 mb-3">
                        <form action="" method="POST">
                            <div class="input-group mb-3">
                                <select class="form-select" name="ville" id="ville">
                                    <option></option>
                                    <!-- create options (ville) for the select input based on the json file -->
                                    <?php foreach ($villes as $ville) : ?>
                                        <option value="<?php echo $ville['ville']; ?>" <?php echo (isset($_POST['ville']) && $_POST['ville'] == $ville['ville']) ? 'selected' : ''; ?>>
                                            <?php echo $ville['ville']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <button class="btn" name="search">Rechercher</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section class="container my-5 " id="service">

            <?php
                $nom = $prenom = $cin = $ville = $email = $telephone = $imgUrl = $speciality = $ville_bricoleur = $query = "";
                $query = "SELECT * FROM `bricoleur` WHERE speciality = '$category'";

                if (isset($_POST['search'])) {
                    $ville_bricoleur = $_POST['ville'];
                    if (!empty($ville_bricoleur)) {
                        $query .= " AND ville_bricoleur = '$ville_bricoleur'";
                    }
                }
                $stmt = $db_connection->prepare($query);
                $stmt->execute();
                $bricoleurList = $stmt->fetchAll(PDO::FETCH_ASSOC);

                echo '<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 ">';
                if (!empty($bricoleurList)) {
                    foreach ($bricoleurList as $bricoleur) {
                        $id = $bricoleur['id_bricoleur'];
                        $nom = $bricoleur['nom_bricoleur'];
                        $prenom = $bricoleur['prenom_bricoleur'];
                        $cin = $bricoleur['cin_bricoleur'];
                        $ville = $bricoleur['ville_bricoleur'];
                        $email = $bricoleur['email'];
                        $telephone = $bricoleur['tele_bricoleur'];
                        $imgUrl = $bricoleur['img_profile'];
                        $speciality = $bricoleur['speciality'];

                        echo '
                            <div class="col mb-3 ">
                                <div class="card shadow align-items-center py-2">
                                    <img src="' . $imgUrl . '" class="w-50 w-lg-75 rounded-circle">
                                    <h5 class="fw-bolder my-2">' . $nom . ' ' . $prenom . '</h5>
                                    <p><i class="fa-solid fa-location-dot"></i> ' . $ville . '</p>
                                    <a href="bricoleurProfile.php?id=' . $id . '" class="btn">Voir le profil</a>
                                </div>
                            </div>
                        ';
                    }

                    echo '</div>';
                } else {
                    echo '<p>Aucun bricoleur disponible dans cette catégorie et cette ville.</p>';
                }
            ?>

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
