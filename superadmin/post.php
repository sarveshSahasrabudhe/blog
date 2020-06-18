<?php include "admin_include/feed_header.php"; ?>

    <!-- Navigation -->
    <?php include "admin_include/feed_header.php"; ?>

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
                                        <img class='img-responsive' src='images/$post_image' alt=''>
                                        <hr>
                                        <p>$post_content</p>
                                        <a class='btn btn-primary' href='#'>Read More<span class='glyphicon glyphicon-chevron-right'></span></a>
                                        <br>
                                    ";
                                
                                    echo "
                                    <div class='well'>
                                        <h4>Leave a Comment:</h4><br>
                                        <form method='post'>
                                            <div class='form-group'>
                                                <!-- <h5>Comment Author:</h5>
                                                <input type='text' name='commentAuthor'><br>
                                                <h5>Comment Email:</h5>
                                                <input type='text' name='commentEmail'><br> -->
                                                <h5>Your Comment:</h5>
                                                <textarea class='form-control' rows='3' name='comment'></textarea>
                                            </div>
                                            <button type='submit' name='addComment' class='btn btn-primary'>Submit</button>
                                        </form>
                                    </div>
                                    ";
                            }
                        }
                        else
                        {
                            echo "Error in Query".mysqli_error($connection);
                        }
                    }
                ?>

                <?php
                    if(isset($_GET['cat']))
                    {
                        $cat_id = $_GET['cat'];
                        $query_show_posts = "SELECT * FROM posts WHERE post_status= 'Approve' AND post_category_id='$cat_id'";
                        $result_show_posts = mysqli_query($connection,$query_show_posts);
                        if($result_show_posts)
                        {
                            while($row=mysqli_fetch_assoc($result_show_posts))
                            {
                                $post_id = $row['post_id'];
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
                                            <a href='post.php?post_view=$post_id'>$post_title</a>
                                        </h2>
                                        <p class='lead'>
                                            by <a href='index.php'>$post_author</a>
                                        </p>
                                        <p><span class='glyphicon glyphicon-time'></span> Posted on $post_date</p>
                                        <hr>
                                        <img class='img-responsive' src='images/$post_image' alt=''>
                                        <hr>
                                        <p>$post_content</p>
                                        <a class='btn btn-primary' href='post.php?post_view=$post_id'>Comment</a>
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
                    if(isset($_GET['post_view']))
                    {
                        $post_id = $_GET['post_view'];
                        $user_img;                       

                        $query_display = "SELECT * FROM comments WHERE comment_post_id=$post_id AND comment_status='Approve'";
                        $result_display = mysqli_query($connection,$query_display);
                        if($result_display)
                        {
                            while($row=mysqli_fetch_assoc($result_display))
                            {
                                $comment_id = $row['comment_id'];
                                $author = $row['comment_author'];
                                $comment_content = $row['comment_content'];

                                $query_temp = "SELECT * FROM users WHERE username='$author'";
                                $result_temp = mysqli_query($connection,$query_temp);
                                if($result_temp)
                                {
                                    while($row=mysqli_fetch_assoc($result_temp))
                                    {
                                        $user_img = $row['user_image'];
                                    }
                                }                                

                                $query_reply = "SELECT * FROM reply WHERE reply_comment_id='$comment_id'";
                                $result_reply = mysqli_query($connection,$query_reply);

                                echo "
                                <div class='media'>
                                    <a class='pull-left' href='#'>
                                        <img class='media-object' src='admin/admin_images/$user_img' height='75px' width='75px' style='border-radius:50%;'>
                                    </a>
                                    <div class='media-body'>
                                        <h4 class='media-heading'>
                                            $author
                                            <br>
                                        </h4>";
                                        echo "$comment_content";
                                echo "  <br>
                                        <a href='nest_comment.php?comment=$comment_id&post_view=$post_id'>Reply</a>";

                                        if($result_reply)
                                        {
                                            $count = mysqli_num_rows($result_reply);
                                            if($count > 0)
                                            {
                                                while($row=mysqli_fetch_assoc($result_reply))
                                                {
                                                    $reply_author = $row['reply_author'];
                                                    $reply_content = $row['reply_content'];            
                                                    
                                                    $query_temp = "SELECT * FROM users WHERE username='$reply_author'";
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
                                                                    <img class='media-object' src='admin/admin_images/$user_img' height='75px' width='75px' style='border-radius:50%;'>
                                                                </a>
                                                                <div class='media-body'>
                                                                    <h4 class='media-heading'>
                                                                        $reply_author
                                                                        <br>
                                                                    </h4>";
                                                                    echo "$reply_content"; 
                                                    echo "      </div>
                                                            </div>
                                                        ";
                                                }
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
                    }
                ?>

                <!-- Comment -->
                <?php
                    if(isset($_POST['addComment']))
                    {
                       if($_SESSION['username_backend'] != null) 
                      {  $author = $_SESSION['username_backend'];
                        $comment = $_POST['comment'];
                        $post_id = $_GET['post_view'];
                        $t = date("Y-m-d");
                        $query_insert = "INSERT INTO comments(comment_post_id, comment_author, comment_content, comment_status, comment_date) VALUES('$post_id','$author','$comment','Unapprove','$t')";
                        $result_insert = mysqli_query($connection,$query_insert);
                        if($result_insert)
                        {
                            header("Location: post.php?post_view=$post_id");
                        }
                        else
                        {
                            die("Error in adding comment!".mysqli_error($connection));
                        }

                        
                    }
                    else
                    header("Location:login_register/login.php");
                }
                ?>

                <!-- Comment -->
                <!-- <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Comment 1
                    </div>
                </div> -->

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
            <?php include "../includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include "../includes/footer.php"; ?>
