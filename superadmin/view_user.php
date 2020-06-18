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
                    <table class="table table-bordered table-responsive table-condensed table-striped table-hover">
                        <thead> 
                            <th style="text-align: center;">User ID</th>
                            <th style="text-align: center;">Username</th>
                            <th style="text-align: center;">Password</th>
                            <th style="text-align: center;">First Name</th>
                            <th style="text-align: center;">Last Name</th>
                            <th style="text-align: center;">Email</th>
                            <th style="text-align: center;">Image</th>
                            <th style="text-align: center;">User Role</th>
                            <th style="text-align: center;">Rand Salt</th>
                            <th colspan="3" style="text-align: center;">Token</th>
                        </thead>
                        <?php
                            $query_show_users = "SELECT * FROM users";
                            $result_show_users = mysqli_query($connection,$query_show_users);
                            if($result_show_users)
                            {
                                $i=1;
                                while($row=mysqli_fetch_assoc($result_show_users))
                                {
                                    $user_id = $row['user_id'];
                                    $username = $row['username'];
                                    $user_password = $row['user_password'];
                                    $user_firstname = $row['user_firstname'];
                                    $user_lastname = $row['user_lastname'];
                                    $user_email = $row['user_email'];
                                    $user_image = $row['user_image'];
                                    $user_role = $row['user_role'];
                                    $user_rand_salt = $row['randSalt'];
                                    $user_token = $row['token'];
                                    echo "
                                        <tbody style='text-align: center;'>
                                            <tr>
                                                <td>$i</td>
                                                <td>$username</td>
                                                <td>$user_password</td>
                                                <td>$user_firstname</td>
                                                <td>$user_lastname</td>
                                                <td>$user_email</td>
                                                <td><img src='admin_images/$user_image' height='100px' width='100px'></td>
                                                <td>$user_role</td>
                                                <td>$user_rand_salt</td>
                                                <td>$user_token</td>
                                                <td><a href='edit_user.php?edit_user=$user_id'>Edit</a></td>
                                                <td><a href='view_user.php?delete_user=$user_id'>Delete</a></td>
                                            </tr>
                                        </tbody>
                                    ";
                                    $i++;
                                }
                            }
                            else
                            {
                                die("Query is Wrong".mysqli_error(($connection)));
                            }
                        ?>
                    </table>                
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    

    <?php
        if(isset($_GET['delete_user']))
        {
            $delete_id = $_GET['delete_user'];
            $query_delete = "DELETE FROM users WHERE user_id='$delete_id'";
            $query_delete_result = mysqli_query($connection,$query_delete);
            if($query_delete_result)
            {
                // echo "<script>

                //     alert('Category deleted!');
                
                // </script>";
                header("Location:view_user.php");
            }
            else
            {
                die("Delete Query is Wrong".mysqli_error(($connection)));
            }
        }
    ?>

    
    <?php include "admin_include/admin_footer.php"; ?>
