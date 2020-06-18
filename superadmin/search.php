<?php include "admin_include/feed_header.php"; ?>
   
    
    <!-- Navigation -->
    <?php include "admin_include/feed_header.php"; ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Search
                </h1>
                <!-- Search Blog Post -->

                <?php
                    if(isset($_POST['searchBtn']))
                    {
                        $searchText = $_POST['searchText'];
                        $search_query = "SELECT * FROM posts WHERE post_tags LIKE '%$searchText%'";
                        $result_search = mysqli_query($connection,$search_query);
                        if($result_search)
                        {
                            $count = mysqli_num_rows($result_search);
                            if($count == 0)
                            {
                                echo "<h1>No Result Found</h1>";
                            }
                            else
                            {
                                if($result_search)
                                {
                                    while($row=mysqli_fetch_assoc($result_search))
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
                                    <img class='img-responsive' src='images/$post_image' alt=''>
                                    <hr>
                                    <p>$post_content</p>
                                    <a class='btn btn-primary' href='post.php?post_view=$post_id'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>
                                    
                                    ";
                                    }
                                }
                                else
                                {
                                    echo "Error in Query".mysqli_error($connection);
                                }
                            }
                        }
                        else
                        {
                            die("Query is wrong".mysqli_error($connection));
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
            <?php include "../includes/sidebar.php"; ?>


        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include "../includes/footer.php"; ?>
