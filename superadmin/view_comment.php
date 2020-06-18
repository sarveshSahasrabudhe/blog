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
                            <th style="text-align: center;">Comment ID</th>
                            <th style="text-align: center;">Post Title</th>
                            <th style="text-align: center;">Comment Author</th>
                            <th style="text-align: center;">Comment Content</th>
                            <th style="text-align: center;">Comment Status</th>
                            <th colspan="2" style="text-align: center;">Comment Date</th>
                        </thead>
                        <?php
                           view_comments();
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
       delete_comment();
    ?>

    
    <?php include "admin_include/admin_footer.php"; ?>
