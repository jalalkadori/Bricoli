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