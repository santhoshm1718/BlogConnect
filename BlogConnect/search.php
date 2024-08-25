<?php require "includes/header.php"; ?>
<?php require "config/config.php"; ?>


<?php 


    if(isset($_POST['search'])) {

 
            $search = $_POST['search'];

            $data = $conn->query("SELECT * FROM posts WHERE title LIKE '%$search%' AND status = 1");


            $data->execute();

            $rows = $data->fetchAll(PDO::FETCH_OBJ);


            if($data->rowCount() == 0) {
                echo "<div class='alert alert-danger bg-danger text-white text-center'>
              no searchs with this post for now</div>";
            }


        }
     else {
        header('location: index.php');
    }




?>



<div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
            <?php if(count($rows) > 0) : ?>
                <div> Number of Posts: (<?php echo count($rows); ?>) </div>
               <?php foreach($rows as $row) : ?>
                    <!-- Post preview-->
                    <div class="post-preview">
                        <a href="http://localhost/BlogConnect/posts/post.php?post_id=<?php echo $row->id; ?>">
                            <h2 class="post-title"><?php echo $row->title; ?></h2>
                            <h3 class="post-subtitle"><?php echo $row->subtitle; ?></h3>
                        </a>
                        <p class="post-meta">
    Posted by
    <?php 

    $posts2 = $conn->prepare("SELECT * FROM users WHERE id=:userid");
    $posts2->bindParam(':userid', $row->userid, PDO::PARAM_INT);
    $posts2->execute();
    $rows2 = $posts2->fetchAll(PDO::FETCH_OBJ);
    foreach ($rows2 as $user) {
        echo '<a href="#!">' . $user->user_name . '</a>';
    }
  
    echo '</br>';
    
    
    echo date('M', strtotime($row->created_at)) . ', ' . date('d', strtotime($row->created_at)) . ' ' . date('Y', strtotime($row->created_at));
    ?>
</p>

                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />
                  <?php endforeach; ?>
                <?php else : ?>
                    <div class='alert alert-danger bg-danger text-white text-center'>
                        no searchs with this post for now</div>

                <?php endif; ?>        
                    
                    <!-- Pager-->
                    
                </div>
</div>

<?php require "includes/footer.php"; ?>
