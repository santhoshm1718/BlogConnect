<?php require "../includes/navbar.php"; ?>


<?php require "../config/config.php"; ?>

<?php 

    if(isset($_GET['del_id'])) {
        $id = $_GET['del_id'];



        $select = $conn->query("SELECT * FROM posts WHERE id =' $id'");
        $select->execute();
        $posts = $select->fetch(PDO::FETCH_OBJ);

        if($_SESSION['user_id'] !== $posts->userid) {
            header('location: http://localhost/BlogConnect/index.php');

        }
        
        else{
        unlink("images/" . $posts->img . "");

$comm_delete = $conn->prepare("DELETE FROM comments WHERE postid = :pid");
$comm_delete->execute([':pid' => $id]);


$delete = $conn->prepare("DELETE FROM posts WHERE id = :id");
$delete->execute([':id' => $id]);
header('location: http://localhost/BlogConnect/index.php');
        }

    }  

?>