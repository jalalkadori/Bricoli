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
                        <a href="./pages/service.php?category='.urlencode($categoryName).'" class="btn ' . $buttonColor . ' rounded-pill">' . $categoryName . '</a>
                    </div>
                </div>
            </div>
        ';
    }
?>