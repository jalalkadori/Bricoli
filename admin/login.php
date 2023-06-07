<?php 
    include("../db_connection.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <script src="https://kit.fontawesome.com/75c6b1327b.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <header class="container-fluid">
            <div class="container-fluid text-center py-3">
                <a>
                    <img src="../logo/logo1500.png" alt="bricoli logo" srcset="bricoli logo" width="200">
                </a>
            </div>
    </header>
    
    <?php
        // Function to verify the entered password against the stored hashed password
        function verifyPassword($password, $hashedPassword) {
            return password_verify($password, $hashedPassword);
        }

        // Initialize variables
        $email = $password = $emailError = $passwordError = '';

        // Check if the login form is submitted
        if (isset($_POST['connecter'])) {
            // Validate and sanitize the email input
            if (empty($_POST['email'])) {
                $emailError = 'Veuillez saisir votre adresse email.';
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $emailError = 'Veuillez saisir une adresse email valide.';
            } else {
                $email = $_POST['email'];
            }

            // Validate and sanitize the password input
            if (empty($_POST['password'])) {
                $passwordError = 'Veuillez saisir votre mot de passe.';
            } else {
                $password = $_POST['password'];
            }

            // Proceed with login if no validation errors
            if (empty($error)) {
                // Retrieve the stored hashed password from the database for the entered email
                $stmt = $db_connection->prepare("SELECT * FROM `admin` WHERE email_admin = ?");
                $stmt->execute([$email]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // Check if the email exists in the database
                if ($row) {
                    $storedHashedPassword = $row['mdp_admin'];

                    // Verify the entered password against the stored hashed password
                    if (verifyPassword($password, $storedHashedPassword)) {
                        // Password is correct, proceed with the login
                        session_start();
                        // Set the session expiration time to 30 minutes (in seconds)
                        $_SESSION['expiration_time'] = time() + 30 * 60;
                       
                        //store any necessary user data
                        $_SESSION['adminEmail'] = $email;
                        $_SESSION['AdminNom'] = $row['nom_admin'];
                        $_SESSION['AdminID'] = $row['id_admin'];
                        // Redirect the user to the dashboard page
                        header("Location: dashboard.php");
                        exit();
                    } else {
                        // Password is incorrect
                        $passwordError = "Mot de passe incorrect. Veuillez réessayer.";
                    }
                } else {
                    // Email does not exist in the database
                    $emailError = "Adresse Email introuvable, Veuillez réessayer. ";
                }
            }
        }
    ?>

    <main>
        <section class="container" id="login">
            <div class="row row-cols-1 row-cols-lg-2">
                <div class="col col-md-6">
                    <img src="../images/security.png" class="w-100" alt="" srcset="">
                </div>
                <div class="col d-flex flex-column justify-content-center align-items-center">
                    <h2>Admin Login</h2>
                    <hr class="border border-dark border-1 opacity-25 w-75">
                    <form method="post" action="login.php" class="w-100">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
                        </div>
                        <?php if (!empty($emailError)) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $emailError; ?>
                            </div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de pass</label>
                            <input type="password" class="form-control" name="password" id="passwordField">
                            <input type="checkbox" class="mt-2" id="showPasswordCheckbox"> Show Password
                        </div>
                        <?php if (!empty($passwordError)) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $passwordError; ?>
                        </div>
                        <?php endif; ?>
                        <button type="submit" class="btn btn-dark w-100 my-2" name="connecter">Se connecter</button>
                    </form>
                </div>
            </div>
        </section>

        

    </main>



    <footer class="container-fluid bg-dark">
        
    </footer>
    <script>
        const passwordField = document.getElementById('passwordField');
        const showPasswordCheckbox = document.getElementById('showPasswordCheckbox');

        showPasswordCheckbox.addEventListener('change', function () {
            if (showPasswordCheckbox.checked) {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        });
    </script>
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>