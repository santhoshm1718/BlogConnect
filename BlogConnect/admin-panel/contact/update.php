<?php 
require "../../config/config.php"; 

if(isset($_GET['query_id'])){
    try {
        $id = $_GET['query_id'];
        
        $update = $conn->prepare("UPDATE contactusquery SET status = 1 WHERE id = :id");
        $update->bindParam(':id', $id, PDO::PARAM_INT);
        $update->execute();

        // Fix the SQL query to delete rows with status = 1
        $delete = $conn->prepare("DELETE FROM contactusquery WHERE status = 1");
        $delete->execute();

        // Redirect after processing
        header('Location: http://localhost/BlogConnect/admin-panel/contact/contact.php');
        exit(); // Stop further execution
    } catch (PDOException $e) {
        // Handle any database errors
        echo "Error: " . $e->getMessage();
    }
}
?>
