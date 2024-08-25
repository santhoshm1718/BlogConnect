<?php 
require "../includes/navbar.php";
require "../config/config.php";

$id = $_SESSION['user_id']; 
$pid = $_GET['like_id'];

$stmt = $conn->prepare("SELECT * FROM likes WHERE user_id = :user_id AND post_id = :post_id");
$stmt->bindParam(":user_id", $id, PDO::PARAM_INT);
$stmt->bindParam(":post_id", $pid, PDO::PARAM_INT);
$stmt->execute();
$select = $stmt->fetchAll();

if(count($select) > 0) {
    $stmt = $conn->prepare("DELETE FROM likes WHERE user_id = :user_id AND post_id = :post_id");
    $stmt->bindParam(":user_id", $id, PDO::PARAM_INT);
    $stmt->bindParam(":post_id", $pid, PDO::PARAM_INT);
    $stmt->execute();
} else {
    $stmt = $conn->prepare("INSERT INTO likes (user_id, post_id) VALUES (:user_id, :post_id)");
    $stmt->bindParam(":user_id", $id, PDO::PARAM_INT);
    $stmt->bindParam(":post_id", $pid, PDO::PARAM_INT);
    $stmt->execute();
}

header("Location: http://localhost/BlogConnect/posts/post.php?post_id=$pid");
exit();
?>
