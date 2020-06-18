<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">

<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>
    <form action="search.php" method="post">
        <div class="input-group">
            <input type="text" name="searchText" class="form-control">
            <span class="input-group-btn">
                <button name="searchBtn"class="btn btn-default" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
    </form>
    <!-- /.input-group -->
</div>

<!-- Blog Categories Well -->
<div class="well">
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-6">
            <ul class="list-unstyled">
            <?php
                    $query = "SELECT * FROM categories";
                    $result = mysqli_query($connection,$query);
                    if($result)
                    {
                        while($row=mysqli_fetch_assoc($result))
                        {
                            $category_id = $row['cat_id'];
                            $categoryName = $row['cat_title'];
                            echo "<li><a href='post.php?cat=$category_id'>$categoryName</a></li>";
                        }
                    }
                    else
                    {
                        echo "Error".mysqli_error($connection);
                    }
                ?>
            </ul>
        </div>
        <!-- /.col-lg-6 -->
        
        <!-- /.col-lg-6 -->
    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<!-- <?php include "includes/widget.php"; ?> -->

</div>