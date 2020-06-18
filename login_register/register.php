<!DOCTYPE html>
<?php
    include "../includes/db.php";
    ob_start();
    session_start();
?>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Register</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

  <link rel="shortcut icon" href="../main/img/logos/main_logo.png" type="image/x-icon">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register</div>
      <div class="card-body">
        <form method="post">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" name="firstName" id="firstName" class="form-control" placeholder="First name" required="required" autofocus="autofocus">
                  <label for="firstName">First name</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Last name" required="required">
                  <label for="lastName">Last name</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" name="userEmail" id="inputEmail" class="form-control" placeholder="Email address" required="required">
              <label for="inputEmail">Email address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="userName" id="inputName" class="form-control" placeholder="Username" required="required">
              <label for="inputName">Username</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" name="userPassword" id="inputPassword" class="form-control" placeholder="Password" required="required">
                  <label for="inputPassword">Password</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="Confirm password" required="required">
                  <label for="confirmPassword">Confirm password</label>
                </div>
              </div>
            </div>
          </div>
          <input type="submit" name="register" class="btn btn-primary btn-block" value="Register">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="login.php">Already have an account? <br> Login</a>
          <!-- <a class="d-block small" href="forgot-password.php">Forgot Password?</a> -->
        </div>
      </div>
    </div>
  </div>
  <?php
      if(isset($_POST['register']))
      {
        $username = $_POST['userName'];
        $password = $_POST['userPassword'];
        $confirm_password = $_POST['confirmPassword'];

        $query = "SELECT * FROM users WHERE username='$username'";
          $result = mysqli_query($connection,$query);
          if(!$result)
          {
            echo "Error".mysqli_error($connection);
          }
          else
          {
            $count = mysqli_num_rows($result);
            if($count>0)
            {
              echo "<script>alert('User/Username already exists!');</script>";
            }
            else
            {
              if($password === $confirm_password)
              {
                $user_firstname = $_POST['firstName'];
                $user_lastname = $_POST['lastName'];
                $user_email = $_POST['userEmail'];
                $query_insert = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email) VALUES('$username','$password','$user_firstname','$user_lastname','$user_email')";
                $result_insert = mysqli_query($connection,$query_insert);
                if($result_insert)
                {
                  header("Location: login.php");
                } 
                else
                {
                  echo "Insert query is wrong!".mysqli_error($connection);
                }
              }
              else if($password !== $confirm_password)
              {
                echo "<script>alert('Passwords do not match!');</script>";
              }
              else
              {
                echo "<script>alert('Something went wrong!');</script>";
              }
            }
          }
        }     
  ?>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
