<?php require "includes/navbar.php"; ?>
<?php require "config/config.php";?>

<?php
if(isset($_POST['post_submit'])) {
    $message = $_POST['Message'];
    $id = $_SESSION['user_id'];

    $insert = $conn->prepare("INSERT INTO contactusquery (user_id, message) VALUES (:id, :message)");

    // Check if the query executed successfully
    if($insert->execute([':id' => $id, ':message' => $message])) {
        echo "<div class='alert alert-success' role='alert'>Message sent successfully!</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Failed to send message. Please try again.</div>";
    }
}
?>
<!-- Page Header-->
<header class="masthead" style="background-image: url('assets/img/contact-bg.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="page-heading">
                    <h1>Contact Us</h1>
                    <span class="subheading">Wanna Add New Categories?Have any Queries</span>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main Content-->
<main class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <p>Want to get in touch? Fill out the form below to send me a message and We will get back to you as soon as possible!</p>
                <div class="my-5">
                    <form method="POST" action="contact.php" enctype="multipart/form-data">
                        <div class="form-outline mb-4">
                            <textarea type="text" name="Message" id="form2Example1" class="form-control" placeholder="Message" rows="8"></textarea>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" name="post_submit" class="btn btn-primary  mb-4 text-center">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require "includes/footer.php"; ?>
