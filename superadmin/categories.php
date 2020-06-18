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
                <form action="categories.php" method="post">
                <div class="form-group col-lg-6">
                    <div class="form-label-group">
                    <input type="text" name="add_category" class="form-control" placeholder="Category Name" >
                    <br>
                    <input type="submit" name="submit" class="btn btn-primary" value="Add">
                    </div>
                </div>
                </form>
                <div class="form-group col-lg-6">
                    <table class="table table-bordered table-responsive table-condensed table-striped table-hover" style="text-align: center;">
                        <thead>
                            <th style="text-align: center;">ID</th>
                            <th colspan="3" style="text-align: center;">Category</th>
                        </thead>
                        <?php
                            insert_categories();
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
      delete_category();
    ?>

    
    <?php include "admin_include/admin_footer.php"; ?>
