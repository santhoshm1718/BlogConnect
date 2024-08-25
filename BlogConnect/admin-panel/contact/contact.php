<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>
<?php 

    if(!isset($_SESSION['adminname'])) {
      header("location: http://localhost/BlogConnect/admin-panel/admins/login-admins.php");
    }

    
    $comments = $conn->query("SELECT*FROM contactusquery WHERE status=0");
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
                    <th scope="col">Query</th>
                    <th scope="col">user</th>
                    <th scope="col">status</th>
                    
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($rows as $row) : ?>
                    <tr>
                      <th scope="row"><?php echo $row->id; ?></th>
                      <td><?php echo $row->message; ?></td>
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
                        <td><a href="http://localhost/BlogConnect/admin-panel/contact/update.php?query_id=<?php echo $row->id; ?>" class="btn btn-danger  text-center ">NotCompleted</a></td>
                     
                      <?php endif; ?>  
                     
                    </tr>
                 <?php endforeach; ?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
</div>


<?php require "../layouts/footer.php"; ?>
