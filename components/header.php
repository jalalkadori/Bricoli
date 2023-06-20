<?php
    echo '
        <header class="container-fluid sticky-top bg-white">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand" href="./index.php">
                        <img src="./logo/logo1500.png" alt="bricoli logo" srcset="bricoli logo" width="150">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse fw-semibold text-uppercase" id="navbarSupportedContent">
                        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="#blog">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Contactez-Nous</a> 
                            </li>
                        </ul>
                        <ul class="navbar-nav mb-2 mb-lg-0">
    ';

    // Check if bricoleur is logged in and the email is set in the session variable
    if (isset($_SESSION['bricoleurEmail'])) {
        echo '
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    '.$_SESSION['bricoleurNom'].' <i class="fa-sharp fa-solid fa-user fa-sm ml-2"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="./bricoleur/profil">Mon Profile</a></li>
                    <li><a class="dropdown-item" href="./bricoleur/logout">Déconnexion</a></li>
                </ul>
            </li>
        ';
    } 
    // Check if bricoleur is logged in and the email is set in the session variable
    elseif (isset($_SESSION['chrcheurEmail'])) {
        echo '
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    '.$_SESSION['chrcheurNom']. ' ' .$_SESSION['chrcheurPrenom'].' <i class="fa-sharp fa-solid fa-user fa-sm ml-2"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="./chercheur/logout">Déconnexion</a></li>
                </ul>
            </li>
        ';
    } else {
        echo '
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Se connecter <i class="fa-solid fa-right-to-bracket"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="bricoleur/login">Bricoleur</a></li>
                    <li><a class="dropdown-item" href="chercheur/login">Chercheur</a></li>
                </ul>
            </li>
        ';
    }

    echo '
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
    ';
?>
