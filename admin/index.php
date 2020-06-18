<?php include "admin_include/admin_header.php"; ?>
<?php
if($_SESSION['temp'] != 'start')
{
    header("Location: ../main/index.php");
}
?>

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
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'>
                                            <?php
                                                $username = $_SESSION['username_backend'];
                                                $query_count_post = "select * from posts WHERE post_author='$username'";
                                                $result_count_post = mysqli_query($connection,$query_count_post);
                                                echo $count_post = mysqli_num_rows($result_count_post);
                                            ?>
                                        </div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="view_post.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'>
                                        <?php
                                            $username = $_SESSION['username_backend'];
                                            $query_count_post = "SELECT * FROM comments WHERE comment_post_id IN(SELECT post_id FROM posts WHERE post_author='$username')";
                                            $result_count_post = mysqli_query($connection,$query_count_post);
                                            echo $count_comments = mysqli_num_rows($result_count_post);
                                        ?>
                                        </div>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="view_comment.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>        

                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'>
                                            <?php
                                                $query_count_post = "select * from categories";
                                                $result_count_post = mysqli_query($connection,$query_count_post);
                                                echo $count_categories = mysqli_num_rows($result_count_post);
                                            ?>
                                        </div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>                                
                </div>
                <!-- div class row close -->

                <br>

                <script type="text/javascript">
                    google.charts.load('current', {'packages':['bar']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() 
                    {
                        var data = google.visualization.arrayToDataTable([
                        ['Data', 'Count'],

                        <?php
                            $element_text = ['Posts','Comments','Categories'];
                            $element_count = [$count_post,$count_comments,$count_categories];
                            for ($i = 0; $i < 3; $i++)
                            {
                                echo "['{$element_text[$i]}'".","."{$element_count[$i]}],";
                            }
                        ?>
                                               
                        ]);

                        var options = 
                        {
                            chart: 
                            {
                                title: '',
                                subtitle: '',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>

                <div id="columnchart_material" style="width: 'auto'; height: 300px;"></div>
            </div>               
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    
    <?php include "admin_include/admin_footer.php"; ?>
