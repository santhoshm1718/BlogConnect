<?php require "../../config/config.php"; ?>


<?php 


    if(!isset($_SESSION['username'])) {
        header("location: http://localhost/BlogConnect/admin-panel/admins/login-admins.php");
    }

    if(isset($_GET['comment_id']) AND isset($_GET['status_comment'])) {
      $id = $_GET['comment_id'];
      $status = $_GET['status_comment'];

     
      //header("location: http://localhost/BlogConnect/404.php");
            if($status == 0) {
                
            
                    $update = $conn->prepare("UPDATE comments SET status = 1  WHERE id = '$id'");

                    $update->execute();

                    header('location: http://localhost/BlogConnect/admin-panel/comments-admins/show-comments.php');
                    

            } else {
                    $update = $conn->prepare("UPDATE comments SET status = 0  WHERE id = '$id'");

                    $update->execute();

                    header('location: http://localhost/BlogConnect/admin-panel/comments-admins/show-comments.php');
            
            }



      } else {
        header("location: http://localhost/BlogConnect/404.php");
      
      }




?>