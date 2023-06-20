<?php
// Arabic names array
$arabicNames = array(
    'أحمد',
    'محمد',
    'علي',
    'عمر',
    'أيمن',
    // Add more Arabic names here
);

// Generate 20 "bricoleur" with random data
$bricoleurs = array();

for ($i = 1; $i <= 20; $i++) {
    $nom = $arabicNames[rand(0, count($arabicNames) - 1)];
    $prenom = $arabicNames[rand(0, count($arabicNames) - 1)];
    $telephone = '05' . rand(10000000, 99999999);
    $cin = 'SA' . rand(100000, 999999);
    $adresse = 'عنوان الشارع, المدينة';
    $ville = 'المدينة';
    $email = strtolower($nom) . '.' . strtolower($prenom) . '@example.com';
    $mdp = 'Password123'; // Set a default password for all bricoleurs

    $bricoleur = array(
        'nom_bricoleur' => $nom,
        'prenom_bricoleur' => $prenom,
        'tele_bricoleur' => $telephone,
        'cin_bricoleur' => $cin,
        'adresse_bricoleur' => $adresse,
        'ville_bricoleur' => $ville,
        'email' => $email,
        'mdp_bricoleur' => $mdp
    );

    $bricoleurs[] = $bricoleur;
}

// Display the generated bricoleurs
foreach ($bricoleurs as $bricoleur) {
    echo "Nom: " . $bricoleur['nom_bricoleur'] . "<br>";
    echo "Prénom: " . $bricoleur['prenom_bricoleur'] . "<br>";
    echo "Téléphone: " . $bricoleur['tele_bricoleur'] . "<br>";
    echo "CIN: " . $bricoleur['cin_bricoleur'] . "<br>";
    echo "Adresse: " . $bricoleur['adresse_bricoleur'] . "<br>";
    echo "Ville: " . $bricoleur['ville_bricoleur'] . "<br>";
    echo "Email: " . $bricoleur['email'] . "<br>";
    echo "Mot de passe: " . $bricoleur['mdp_bricoleur'] . "<br><br>";
}
?>
