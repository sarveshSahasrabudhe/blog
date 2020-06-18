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
                            <th style="text-align: center;">Post ID</th>
                            <th style="text-align: center;">Category Title</th>
                            <th style="text-align: center;">Post Title</th>
                            <th style="text-align: center;">Post Author</th>
                            <th style="text-align: center;">Post Date</th>
                            <th style="text-align: center;">Post Image</th>
                            <th style="text-align: center;">Post Content</th>
                            <th style="text-align: center;">Post Tags</th>
                            <th style="text-align: center;">Comment Count</th>
                            <th colspan="3" style="text-align: center;">Post Status</th>
                        </thead>
                        <?php
                           view_posts();
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
     delete_posts();
    ?>

    
    <?php include "admin_include/admin_footer.php"; ?>
