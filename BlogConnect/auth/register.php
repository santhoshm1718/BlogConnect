<?php require  "../includes/header.php"; ?>
<?php require  "../config/config.php"; ?>

<?php

  if(isset($_SESSION['username'])) {
    header("location: http://localhost/BlogConnect/index.php");
  }


  if(isset($_POST['submit'])) {

      if($_POST['email'] == '' OR $_POST['username'] == '' OR $_POST['password'] == '') {
        echo "<div class='alert alert-danger  text-center  role='alert'>
                 enter data into the inputs
              </div>";
      } else {
        $email = $_POST['email'];
        $firstname = $_POST['fname'];
        $secondname = $_POST['lname'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
        // Prepare and execute the INSERT statement
        $insert = $conn->prepare("INSERT INTO users (fname, lname, email, password, user_name) VALUES
            (:fname, :lname, :email, :password, :username)");
        
        $insert->bindParam(':email', $email, PDO::PARAM_STR);
        $insert->bindParam(':fname', $firstname, PDO::PARAM_STR);
        $insert->bindParam(':lname', $secondname, PDO::PARAM_STR);
        $insert->bindParam(':username', $username, PDO::PARAM_STR);
        $insert->bindParam(':password', $password, PDO::PARAM_STR);
        
        $insert->execute();
    
        header("location: login.php");



      }
    
  }

?>

            <form method="POST" action="register.php">
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
               
              </div>

              <div class="form-outline mb-4">
                <input type="" name="fname" id="form2Example1" class="form-control" placeholder="firstname" />
               
              </div>
              
              <div class="form-outline mb-4">
                <input type="" name="lname" id="form2Example1" class="form-control" placeholder="lastname" />
               
              </div>
              <div class="form-outline mb-4">
                <input type="" name="username" id="form2Example1" class="form-control" placeholder="username" />
               
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />
                
              </div>



              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Register</button>

              <!-- Register buttons -->
              <div class="text-center">
                <p>Aleardy a member? <a href="login.php">Login</a></p>
                

               
              </div>
            </form>


<?php require  "../includes/footer.php"; ?>      