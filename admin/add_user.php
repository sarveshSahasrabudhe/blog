<?php include "admin_include/admin_header.php"; ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "admin_include/admin_navbar.php"; ?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome
                            <small><?php echo $_SESSION['user_firstname']; ?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="form-group col-lg-12">
                <form method='post'>
                    <fieldset>
                        <legend>Add User</legend>
                                    Username: <br>
                                    <input type='text' name='userName'><br><br>
                                    Password: <br>
                                    <input type='password' name='userPassword'><br><br>
                                    First Name: <br>
                                    <input type='text' name='firstName'><br><br>
                                    Last Name: <br>
                                    <input type='text' name='lastName'><br><br>
                                    Email: <br>
                                    <input type='email' name='userEmail'><br><br>
                                    User Image: <br>
                                    <input type='file' name='userImage'><br><br>
                                    User Role: <br>
                                    <input type='text' name='userRole'><br><br>
                                    Rand Salt: <br>
                                    <input type='text' name='randSalt'><br><br>
                                    Token: <br>
                                    <input type='text' name='userToken'><br>
                                    <br>
                                    <input type='submit' name='addUser' class='btn btn-primary' value='Add'>                                                                       
                    </fieldset>
                </form>        
                                <?php
                                    add_user();
                                ?>
                        </div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    
    <?php include "admin_include/admin_footer.php"; ?>
