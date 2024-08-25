<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>
<?php 

    if(!isset($_SESSION['adminname'])) {
      header("location: http://localhost/BlogConnect/admin-panel/admins/login-admins.php");
    }

    
    $comments = $conn->query("SELECT posts.id AS id, posts.title AS title, comments.id AS comment_id,
     comments.postid AS id_post_comment, comments.user_id AS
     user_id, comments.comment AS comment, comments.status
     AS status_comment		
     FROM comments 
    JOIN posts ON posts.id = comments.postid");
    $comments->execute();
    $rows = $comments->fetchAll(PDO::FETCH_OBJ);

?>
<div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Comments</h5>
            
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">title</th>
                    <th scope="col">comment</th>
                    <th scope="col">user</th>
                    <th scope="col">status</th>
                    <th scope="col">delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($rows as $row) : ?>
                    <tr>
                      <th scope="row"><?php echo $row->comment_id; ?></th>
                      <td><?php echo $row->title; ?></td>
                      <td><?php echo $row->comment; ?></td>
                      <?php 
    $posts2 = $conn->prepare("SELECT * FROM users WHERE id=:userid");
    $posts2->bindParam(':userid', $row->user_id, PDO::PARAM_INT);
    $posts2->execute();
    $rows2 = $posts2->fetchAll(PDO::FETCH_OBJ);
    foreach ($rows2 as $user) {
        echo '<td>' . $user->user_name . '</td>';
    }
    ?>
                      <?php if($row->status_comment == 0) : ?>
                        <td><a href="http://localhost/BlogConnect/admin-panel/comments-admins/status-comments.php?comment_id=<?php echo $row->comment_id; ?>&status_comment=<?php echo $row->status_comment; ?>" class="btn btn-danger  text-center ">deactivated</a></td>
                      <?php else : ?>
                        <td><a href="http://localhost/BlogConnect/admin-panel/comments-admins/status-comments.php?comment_id=<?php echo $row->comment_id; ?>&status_comment=<?php echo $row->status_comment; ?>" class="btn btn-success  text-center ">activated</a></td>
                      <?php endif; ?>  
                      <td><a href="http://localhost/BlogConnect/admin-panel/comments-admins/delete-comments.php?comment_id=<?php echo $row->comment_id; ?>" class="btn btn-danger  text-center ">delete</a></td>
                    </tr>
                 <?php endforeach; ?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
</div>


<?php require "../layouts/footer.php"; ?>
