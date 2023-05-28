<?php 
            try{
              $db_connection = new PDO("mysql:host=127.0.0.1;dbname=gestion_formation;charset=utf8mb4;", 'root', '');

            }
            catch(PDOException $e){
              echo 'Erreur : ' . $e->getMessage();
            }
?>