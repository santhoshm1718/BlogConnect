<?php //require "../includes/navbar.php"; ?>


<?php require "../../config/config.php"; ?>

<?php 

if(isset($_GET['de_id'])) {
    $id = $_GET['de_id'];

    $delete_comments = $conn->prepare("DELETE FROM comments WHERE postid IN (SELECT id FROM posts WHERE categoryid = :id)");
    $delete_comments->execute([':id' => $id]);

    
    $delete_posts = $conn->prepare("DELETE FROM posts WHERE categoryid = :id");
    $delete_posts->execute([':id' => $id]);

    $delete_category = $conn->prepare("DELETE FROM categories WHERE id = :id");
    $delete_category->execute([':id' => $id]);

    header('location: http://localhost/BlogConnect/admin-panel/categories-admins/show-categories.php');
} else {
    header("location: http://localhost/BlogConnect/404.php");
    
    exit();
}  

?>