<?php include "includes/header.php"; ?>
<?php
if($_SESSION['temp'] != 'start')
{
    header("Location: main/index.php");
}
?>
    
    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                <?php if($_SESSION['user_firstname'] != null)
                    echo $_SESSION['user_firstname']."'s"; ?> Feed
                </h1>

                <!-- First Blog Post -->
                <?php
                    if($_SESSION['username_backend'] != null)
                    {
                        $username=$_SESSION['username_backend'];
                        $query_show_post = "SELECT * FROM posts WHERE post_status='Approve' AND post_author = '$username' ORDER BY post_date DESC";
                        $result_show_post = mysqli_query($connection,$query_show_post);
                        if($result_show_post)
                        {
                            while($row=mysqli_fetch_assoc($result_show_post))
                            {
                                $post_id = $row['post_id'];
                                $post_title = $row['post_title'];
                                $post_author = $row['post_author'];
                                $post_date = $row['post_date'];
                                $post_image = $row['post_image'];
                                $post_content = $row['post_content'];
                            

                                echo "
                                <h1 class='page-header'>
                                $post_title
                                </h1>
            
                            <!-- First Blog Post -->
                            <h2>
                                <a href='post.php?post_view=$post_id'>$post_title</a>
                            </h2>
                            <p class='lead'>
                                by <a href='index.php'>$post_author</a>
                            </p>
                            <p><span class='glyphicon glyphicon-time'></span> Posted on $post_date</p>
                            <hr>
                            <img class='img-responsive' height='600px' width='600px' src='admin/admin_images/$post_image' alt=''>
                            <hr>
                            <p>$post_content</p>
                            <a class='btn btn-primary' href='post.php?post_view=$post_id'>Comment</a>";
                            }
                        }
                        else
                        {
                            echo "Error in Query".mysqli_error($connection);
                        }
                    }
                ?>

                <hr>

                <!-- Pager -->
                <!-- <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul> -->

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>


        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php"; ?>
