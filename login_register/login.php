<!DOCTYPE html>
<?php
    include "../includes/db.php";
    ob_start();
    session_start();
    $_SESSION['temp']='start';
?>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

  <link rel="shortcut icon" href="../main/img/logos/main_logo.png" type="image/x-icon">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form method="post">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="userName" id="inputUser" class="form-control" placeholder="Username" required="required" autofocus="autofocus">
              <label for="inputUser">Username</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" name="userPassword" id="inputPassword" class="form-control" placeholder="Password" required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <!-- <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me">
                Remember Password
              </label>
            </div>
          </div> -->
          <!-- <a name="login" class="btn btn-primary btn-block" href="../index.php">Login</a> -->
          <input type="submit" name="login" class="btn btn-primary btn-block" value="Login">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="register.php">Don't have an accont? <br> Register</a>
          <!-- <a class="d-block small" href="forgot-password.php">Forgot Password?</a> -->
        </div>
      </div>
    </div>
  </div>
  <?php
      if(isset($_POST['login']))
      {
        $username = $_POST['userName'];
        $password = $_POST['userPassword'];

        $query = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($connection,$query);
        if(!$result)
        {
          echo "Error".mysqli_error($connection);
        }
        $user_id="";
        $user_firstname="";
        $user_lastname="";
        $username_backend="";
        $password_backend="";
        $role="";          
        while($row=mysqli_fetch_assoc($result))
        {
          $user_id = $row['user_id'];
          $user_firstname = $row['user_firstname'];
          $user_lastname = $row['user_lastname'];
          $username_backend = $row['username'];
          $password_backend = $row['user_password'];
          $user_email = $row['user_email'];
        }
        if($username == $username_backend && $password == $password_backend)
        {
          $_SESSION['user_id'] = $user_id;
          $_SESSION['user_firstname'] = $user_firstname;
          $_SESSION['user_lastname'] = $user_lastname;
          $_SESSION['username_backend'] = $username_backend;
          $_SESSION['password_backend'] = $password_backend;
          $_SESSION['user_email'] = $user_email;
          if($_SESSION['user_email'] == 'super@gmail.com' && $_SESSION['user_id'] == 4 )
          {
            header("Location: ../superadmin/index.php");

          }
          else
          header("Location: ../index.php");
        }
        else
        {
          echo "<script>alert('Invalid username/password!');</script>";
          // echo "<script>window.open('../index.php')</script>";
          
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
