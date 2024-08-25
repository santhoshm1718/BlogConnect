<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>
<?php 

    if(!isset($_SESSION['adminname'])) {
      header("location: http://localhost/BlogConnect/admin-panel/admins/login-admins.php");
    }

    
    $posts = $conn->query("SELECT posts.id AS id, posts.title AS title, 
     posts.userid AS user_id, categories.catname AS name, posts.status AS 
     status FROM categories 
    JOIN posts ON categories.id = posts.categoryid");
    $posts->execute();
    $rows = $posts->fetchAll(PDO::FETCH_OBJ);

?>
<div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Posts</h5>
            
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">title</th>
                    <th scope="col">category</th>
                    <th scope="col">user</th>
                    <th scope="col">status</th>
                    <th scope="col">delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($rows as $row) : ?>
                    <tr>
    <th scope="row"><?php echo $row->id; ?></th>
    <td><?php echo $row->title; ?></td>
    <td><?php echo $row->name; ?></td>
    <?php 
    $posts2 = $conn->prepare("SELECT * FROM users WHERE id=:userid");
    $posts2->bindParam(':userid', $row->user_id, PDO::PARAM_INT);
    $posts2->execute();
    $rows2 = $posts2->fetchAll(PDO::FETCH_OBJ);
    foreach ($rows2 as $user) {
        echo '<td>' . $user->user_name . '</td>';
    }
    ?>
    <?php if($row->status == 0) : ?>
        <td><a href="status-posts.php?status=<?php echo $row->status; ?>&id=<?php echo $row->id; ?>" class="btn btn-danger text-center">deactivated</a></td>
    <?php else : ?>
        <td><a href="status-posts.php?status=<?php echo $row->status; ?>&id=<?php echo $row->id; ?>" class="btn btn-primary text-center">activated</a></td>
    <?php endif; ?>  
    <td><a href="delete-posts.php?po_id=<?php echo $row->id; ?>" class="btn btn-danger text-center">delete</a></td>
</tr>


                 <?php endforeach; ?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
</div>


<?php require "../layouts/footer.php"; ?>
