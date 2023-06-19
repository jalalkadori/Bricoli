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