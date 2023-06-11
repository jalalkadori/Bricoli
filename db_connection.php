<?php 
    try{
      $db_connection = new PDO("mysql:host=127.0.0.1;dbname=bricoconnect;charset=utf8mb4;", 'root', '');
      
    }
    catch(PDOException $e){
      echo 'Erreur : ' . $e->getMessage();
      
    }

      // Set error reporting to display all errors except warnings
        error_reporting(E_ALL & ~E_WARNING);

        // Set the error log file path
        $logFile = 'error.log';

        // Custom error handler function
        function customErrorHandler($errno, $errstr, $errfile, $errline) {
            global $logFile;
            // Append the error message to the error log file
            file_put_contents($logFile, "Warning: $errstr in $errfile on line $errline" . PHP_EOL, FILE_APPEND);
        }

        // Register the custom error handler
        set_error_handler('customErrorHandler');

?>