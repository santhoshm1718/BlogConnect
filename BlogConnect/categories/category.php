<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php 


    if(isset($_GET['cat_id'])) {
        $id = $_GET['cat_id'];

        $posts = $conn->query("SELECT posts.id AS id, posts.title AS title, 
        posts.subtitle AS subtitle, posts.userid AS user_id, posts.created_at AS 
        created_at, posts.categoryid AS category_id, posts.status AS status
          FROM categories 
        JOIN posts ON categories.id = posts.categoryid 
        WHERE posts.categoryid = '$id' AND status = 1");
        $posts->execute();
        $rows = $posts->fetchAll(PDO::FETCH_OBJ);


    } else {
        header("location: http://localhost/BlogConnect/404.php");
       
    }
   


?>
<div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">

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
                            $posts2->bindParam(':userid', $row->user_id, PDO::PARAM_INT);
                            $posts2->execute();
                            $rows2 = $posts2->fetchAll(PDO::FETCH_OBJ);
                            foreach ($rows2 as $user) {
                                echo '<a href="#!">' . $user->user_name . '</a>';
                            }
                            
                            
                            
                            ?>
                           <!-- <a href="#!"><?php //echo $row->user_name; ?></a> -->
                            <?php echo date('M', strtotime($row->created_at))  . ',' .  date('d', strtotime($row->created_at)) . ' ' . date('Y', strtotime($row->created_at)); ?>
                        </p>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />
                  <?php endforeach; ?>
                    <!-- Pager-->
                    
                </div>
            </div>


<?php require "../includes/footer.php"; ?>