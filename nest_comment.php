<?php include "includes/header.php"; ?>

    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->
                <?php
                    if(isset($_GET['post_view']))
                    {
                        $post_id = $_GET['post_view'];
                        $query_show_posts = "SELECT * FROM posts WHERE post_id='$post_id'";
                        $result_show_posts = mysqli_query($connection,$query_show_posts);
                        if($result_show_posts)
                        {
                            while($row=mysqli_fetch_assoc($result_show_posts))
                            {
                                $post_cat_id = $row['post_category_id'];
                                $post_title = $row['post_title'];
                                $post_author = $row['post_author'];
                                $post_date = $row['post_date'];
                                $post_image = $row['post_image'];
                                $post_content = $row['post_content'];
                                $post_tags = $row['post_tags'];
                                $post_comment_count = $row['post_comment_count'];
                                $post_status = $row['post_status']; 
                                
                                echo "
                                        <h1 class='page-header'>
                                            $post_title
                                        </h1>
                        
                                        <!-- First Blog Post -->
                                        <h2>
                                            <a href='#'>$post_title</a>
                                        </h2>
                                        <p class='lead'>
                                            by <a href='index.php'>$post_author</a>
                                        </p>
                                        <p><span class='glyphicon glyphicon-time'></span> Posted on $post_date</p>
                                        <hr>
                                        <img class='img-responsive' src='admin/admin_images/$post_image' alt='Error Image'>
                                        <hr>
                                        <p>$post_content</p>
                                        <a class='btn btn-primary' href='#'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>
                                        <br>
                                    ";
                            }
                        }
                        else
                        {
                            echo "Error in Query".mysqli_error($connection);
                        }
                    }
                ?>

               <br>
                <!-- Blog Comments -->

                <!-- Comments Form -->

                <hr>

                <!-- Posted Comments -->

                <?php
                    $user_img;

                    $post_id = $_GET['post_view'];
                    $query_display = "SELECT * FROM comments WHERE comment_post_id=$post_id";
                    $result_display = mysqli_query($connection,$query_display);
                    if($result_display)
                    {
                        while($row=mysqli_fetch_assoc($result_display))
                        {
                            $comment_id = $row['comment_id'];
                            $author = $row['comment_author'];
                            $comment = $row['comment_content'];

                            $query_temp = "SELECT * FROM users WHERE username='$author'";
                            $result_temp = mysqli_query($connection,$query_temp);
                            if($result_temp)
                            {
                                while($row=mysqli_fetch_assoc($result_temp))
                                {
                                    $user_img = $row['user_image'];
                                }
                            }

                            echo "
                                <div class='media'>
                                    <a class='pull-left' href='#'>
                                        <img class='media-object' src='admin/admin_images/$user_img' alt='error in image' height='75px' width='75px'>
                                    </a>
                                    <div class='media-body>
                                        <h4 class='media-heading'>
                                            $author:
                                        </h4><br>
                                        $comment
                                        <br>";
                                        if(isset($_GET['comment']))
                                        {
                                            $curr_comment_id = $_GET['comment'];
                                            if($curr_comment_id == $comment_id)
                                            {
                                                echo "
                                                    <div class='well'>
                                                        <h4>Leave a Reply:</h4><br>
                                                        <form method='post'>
                                                            <div class='form-group'>
                                                                <!-- <h5>Comment Author:</h5>
                                                                <input type='text' name='commentAuthor'><br>
                                                                <h5>Comment Email:</h5>
                                                                <input type='text' name='commentEmail'><br> -->
                                                                <h5>Your Comment:</h5>
                                                                <textarea class='form-control' rows='3' name='reply'></textarea>
                                                            </div>
                                                            <input type='submit' name='addReply' class='btn btn-primary' value='Reply'></input>
                                                        </form>
                                                    </div>
                                                    ";
                                            }
                                        }
                            echo "
                                    </div>
                                </div>
                                ";
                        }
                    }
                    else
                    {
                        die("Error in displaying comment!".mysqli_error($connection));
                    }
                ?>

                <!-- Comment -->
                <?php
                if($_SESSION['username_backend'] != null)
                {
                    $username = $_SESSION['username_backend'];
                    $user_img;
                    $query_temp = "SELECT * FROM users WHERE username='$username'";
                    $result_temp = mysqli_query($connection,$query_temp);
                    if($result_temp)
                    {
                        while($row=mysqli_fetch_assoc($result_temp))
                        {
                            $user_img = $row['user_image'];
                        }
                    }

                    if(isset($_POST['addReply']))
                    {
                        // $query_display = "SELECT * FROM comments WHERE comment_post_id=$post_id";
                        // $result_display = mysqli_query($connection,$query_display);
                        // if($result_display)
                        // {
                        //     echo "
                        //     <div class='media'>
                        //         <a class='pull-left' href='#'>
                        //             <img class='media-object' src='admin/admin_images/$user_img' height='75px' width='75px' style='border-radius:50%;'>
                        //         </a>
                        //         <div class='media-body>
                        //             <h4 class='media-heading'>
                        //                 $author:
                        //             </h4><br>
                        //             $comment
                        //         </div>
                        //     </div>
                        //     ";
                        // }
                        // else
                        // {
                        //     die("Error in displaying comment!".mysqli_error($connection));
                        // }

                        $comment_id = $_GET['comment'];
                        $author = $_SESSION['username_backend'];
                        $reply = $_POST['reply'];
                        $post_id = $_GET['post_view'];
                        $t = date("Y-m-d");
                        
                        $query_insert = "INSERT INTO reply(reply_comment_id, reply_author, reply_content, reply_date) VALUES('$comment_id','$author','$reply','$t')";
                        $result_insert = mysqli_query($connection,$query_insert);
                        if($result_insert)
                        {
                            // echo "Successfully added reply!";
                            header("Location: post.php?post_view=$post_id");
                        }
                        else
                        {
                            die("Error in adding comment!".mysqli_error($connection));
                        }
                    }
                }
                ?>

                <!-- Comment -->
                <div class="media">
                    <!-- <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a> -->
                    <div class="media-body">
                        <!-- <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Comment 2 -->
                        <!-- Nested Comment -->
                        <div class="media">
                            <!-- <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a> -->
                            <div class="media-body">
                                <!-- <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Nested Comment  -->
                            </div>
                        </div>
                        <!-- End Nested Comment -->
                    </div>
                </div>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php"; ?>
