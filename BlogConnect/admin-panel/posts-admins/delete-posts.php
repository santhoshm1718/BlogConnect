<?php require "../../config/config.php"; ?>


<?php 

if(isset($_GET['po_id'])) {
    $id = $_GET['po_id'];

    
    $delete_comments = $conn->prepare("DELETE FROM comments WHERE postid = :id");
    $delete_comments->execute([':id' => $id]);

   
    $delete_post = $conn->prepare("DELETE FROM posts WHERE id = :id");
    $delete_post->execute([':id' => $id]);

    header('Location: http://localhost/BlogConnect/admin-panel/posts-admins/show-posts.php');
   
} else {
    header("Location: http://localhost/BlogConnect/404.php");
   
}

?>