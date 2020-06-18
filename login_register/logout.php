<!DOCTYPE html>
<?php
    include "../includes/db.php";
    ob_start();
    session_start();
?>
<html lang="en">
<head>
  <title>Logout</title>
</head>
<body>
    <?php
        $_SESSION['user_id'] = null;
        $_SESSION['user_firstname'] = null;
        $_SESSION['user_lastname'] = null;
        $_SESSION['username_backend'] = null;
        $_SESSION['password_backend'] = null;
        $_SESSION['user_role'] = null;
        $_SESSION['temp'] = null;
        header("Location: ../index.php");
    ?>
</body>
</html>
