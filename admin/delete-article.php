<?php
include("../db_connection.php");
include("session-config.php");
// Check if the article ID is present in the URL
if (isset($_GET['id'])) {
    $articleId = $_GET['id'];

    // Prepare the DELETE statement to delete the article from the database
    $stmt = $db_connection->prepare("DELETE FROM article WHERE id_Article = :articleId");
    $stmt->bindParam(':articleId', $articleId);
    $stmt->execute();

    // Check if any rows were affected (if the article was successfully deleted)
    if ($stmt->rowCount() > 0) {
        // Deletion successful
        $_SESSION['deleteMessage'] = "L'article a été supprimé avec succès.";
        $_SESSION['alertClass'] = "alert-success";
    } else {
        // Article not found or deletion failed
        $_SESSION['deleteMessage'] = "La suppression de l'article a échoué.";
        $_SESSION['alertClass'] = "alert-danger";
    }
} else {
    // No article ID in the URL
    $_SESSION['deleteMessage'] = "Aucun identifiant d'article spécifié.";
    $_SESSION['alertClass'] = "alert-warning";
}

// Redirect to the blog page
header("Location: blog");
exit();
?>






