<?php 

   //Insert Categories

   function insert_categories()
   {
    global $connection;
    if(isset($_POST['submit']))
    {
        
        $cat_title_from_user = $_POST['add_category'];
        if(empty($cat_title_from_user))
        {
            echo "<script>
            alert('Data Should Not Be Empty!'); 
            </script> ";
        }
        else
        {
            $query_addTitle = "INSERT INTO categories(cat_title) VALUES('$cat_title_from_user') ";
            $result_addTitle = mysqli_query($connection,$query_addTitle);
            if($result_addTitle)
            {
                // echo "Category Added Successfully!";
            }
            else
            {
                die("Error While Adding Data".mysqli_error($connection));
            }
        }
    }
    // show categories
    $query_show_category = "SELECT * FROM categories";
    $result_show_categories = mysqli_query($connection,$query_show_category);
    if($result_show_categories)
    {
        $i=1;
        while($row=mysqli_fetch_assoc($result_show_categories))
        {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            echo "
                <tbody>
                    <tr>
                        <td>$i</td>
                        <td>$cat_title</td>
                        <td><a href='edit.php?edit=$cat_id'>Edit</a></td>
                        <td><a href='categories.php?delete=$cat_id'>Delete</a></td>
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
}


//delete category

function delete_category()
{
    global $connection;
    if(isset($_GET['delete']))
    {
        $delete_id = $_GET['delete'];
        $query_delete = "DELETE FROM categories WHERE cat_id='$delete_id'";
        $query_delete_result = mysqli_query($connection,$query_delete);
        if($query_delete_result)
        {
            echo "<script>

                alert('Category deleted!');
            
            </script>";
            header("Location:categories.php");
        }
        else
        {
            die("Delete Query is Wrong".mysqli_error(($connection)));
        }
    }
}


//edit categoty or update category

function update_category()
{
    global $connection;
    if(isset($_GET['edit']))
    {
        $edit_id = $_GET['edit'];
        $query_edit = "SELECT * FROM categories WHERE cat_id='$edit_id'";
        $query_edit_result = mysqli_query($connection,$query_edit);
        if($query_edit_result)
        {
            while($row=mysqli_fetch_assoc($query_edit_result))
            {
                $edit_cat_title = $row['cat_title'];
                echo "
                <input type='text' name='edit_category22' class='form-control' value='$edit_cat_title'>
                ";
            }
            //header("Location:edit.php");
        }
        else
        {
            die("Edit Query is Wrong".mysqli_error(($connection)));
        }
    }
    if(isset($_POST['update22']))
    {
        $new_edit_id = $_GET['edit'];
        $updated_title = $_POST['edit_category22'];
        $query_update = "UPDATE categories SET cat_title='$updated_title' WHERE cat_id='$new_edit_id'";
        $result_update = mysqli_query($connection,$query_update);
        if($result_update)
        {
            //echo "Updated Successfully!";
            header("Location:categories.php");
        }
        else
        {
            die("Update Query is Wrong".mysqli_error(($connection)));
        }
    }
}



//display function in edit.php

function display_in_edit()
{
    global $connection;
    if(isset($_POST['submit']))
    {
        $cat_title_from_user = $_POST['add_category'];
        if(empty($cat_title_from_user))
        {
            echo "<script>
            alert('Data Should Not Be Empty!'); 
            </script> ";
        }
        else
        {
            $query_addTitle = "INSERT INTO categories(cat_title) VALUES('$cat_title_from_user') ";
            $result_addTitle = mysqli_query($connection,$query_addTitle);
            if($result_addTitle)
            {
                // echo "Category Added Successfully!";
            }
            else
            {
                die("Error While Adding Data".mysqli_error($connection));
            }
        }
    }

    $query_show_category = "SELECT * FROM categories";
    $result_show_categories = mysqli_query($connection,$query_show_category);
    if($result_show_categories)
    {
        $i=1;
        while($row=mysqli_fetch_assoc($result_show_categories))
        {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            echo "
                <tbody>
                    <tr>
                        <td>$i</td>
                        <td>$cat_title</td>
                        <td><a href='categories.php?edit=$cat_id'>Edit</a></td>
                        <td><a href='categories.php?delete=$cat_id'>Delete</a></td>
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
}



// add post function

function add_post()
{
    global $connection;
    $query_cat = "SELECT * FROM categories";
    $result_cat = mysqli_query($connection,$query_cat);
    if($result_cat)
    {        
        while($row=mysqli_fetch_assoc($result_cat))
        {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            echo "
                <option value='$cat_id'>$cat_title</option><br>";
        }
    }

echo "</select>";

    echo "
    <br><br>
    Post Title: <br>
    <input type='text' name='postTitle'><br><br>
    Post Image: <br>
    <input type='file' accept='image/*' name='postImage'><br><br>
    Post Content: <br>
    <textarea class='form-control' rows='3' name='postContent'></textarea><br><br>
    Post Tags: <br>
    <input type='text' name='postTags'><br><br>
    <br>
    <input type='submit' name='addPost' class='btn btn-primary' value='Add'>
</fieldset>
</form>";        
    if(isset($_POST['addPost']))
    {   
        $temp_username =  $_SESSION['user_firstname'];
        $temp_id = $_SESSION['user_id'];
        $post_cat_id = $_POST['catTitle'];
        $post_title = $_POST['postTitle'];
        $post_author = $_SESSION['username_backend'];
        $post_date = date("Y-m-d");
        //file upload
        $post_images = $_POST['postImage'];
        $post_image = $_FILES['postImage']['name'];

        // $file_type = $_FILES['postImage']['type'];
        // $allowed = array("postImage/png");
        // if(!in_array($file_type, $allowed))
        // {
        //     echo "<script>alert('extinction not allowed')</script>";
        // }

        $post_image_name = $temp_username. $temp_id. $post_image;
        $post_image_temp = $_FILES['postImage']['tmp_name'];
        move_uploaded_file($post_image_temp, "admin_images/$post_image_name");
        //end file upload

        
        $post_content = $_POST['postContent'];
        $post_tags = $_POST['postTags'];
        $query_add = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status)
                    VALUES('$post_cat_id','$post_title','$post_author','$post_date','$post_image_name','$post_content','$post_tags','0','Approve')";
        $result_add = mysqli_query($connection,$query_add);
        if($result_add)
        {
            echo "Added Successfully!";
            header("Location:view_post.php");
        }
        else
        {
            die("Add Query is Wrong".mysqli_error(($connection)));
        }
    }
}

//add user function
function add_user()
{
        global $connection;
    if(isset($_POST['addUser']))
    {   
        $username = $_POST['userName'];
        $user_password = $_POST['userPassword'];
        $user_firstname = $_POST['firstName'];
        $user_lastname = $_POST['lastName'];
        $user_email = $_POST['userEmail'];
        $user_image = $_POST['userImage'];
        $user_role = $_POST['userRole'];
        $user_rand_salt = $_POST['randSalt'];
        $user_token = $_POST['userToken'];                                                                                       
        $query_add = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_image, user_role, randSalt, token)
                    VALUES('$username','$user_password','$user_firstname','$user_lastname','$user_email','$user_image','$user_role','$user_rand_salt','$user_token')";
        $result_add = mysqli_query($connection,$query_add);
        if($result_add)
        {
            echo "Added Successfully!";
            header("Location:view_user.php");
        }
        else
        {
            die("Add Query is Wrong".mysqli_error(($connection)));
        }
    }
}

//approve disapprove comments
function app_dis_comments()
{
    global $connection;
    if(isset($_GET['toggle']) && isset($_GET['com_id']))
    {
        $comment_id = $_GET['com_id'];
        $toggle = $_GET['toggle'];
        if($toggle == 'Approve')
        {
            $query_update = "UPDATE comments SET comment_status='Unapprove' WHERE comment_id='$comment_id'";
            $result_update = mysqli_query($connection,$query_update);
            if($result_update)
            {
                header("Location: view_comment.php");
            }
        }
        else if($toggle == 'Unapprove')
        {
            $query_update = "UPDATE comments SET comment_status='Approve' WHERE comment_id='$comment_id'";
            $result_update = mysqli_query($connection,$query_update);
            if($result_update)
            {
                header("Location: view_comment.php");
            }
        }                               
    }
}

//approve disapprove posts
function app_dis_posts()
{
    global $connection;
    if(isset($_GET['toggle']) && isset($_GET['postID']))
    {
        $post_id = $_GET['postID'];
        $toggle = $_GET['toggle'];
        if($toggle == 'Approve')
        {
            $query_update = "UPDATE posts SET post_status='Unapprove' WHERE post_id='$post_id'";
            $result_update = mysqli_query($connection,$query_update);
            if($result_update)
            {
                header("Location: view_post.php");
            }
        }
        else if($toggle == 'Unapprove')
        {
            $query_update = "UPDATE posts SET post_status='Approve' WHERE post_id='$post_id'";
            $result_update = mysqli_query($connection,$query_update);
            if($result_update)
            {
                header("Location: view_post.php");
            }
        }                               
    }
}


//edit comments

function edit_comments()
{
    global $connection;
    if(isset($_GET['edit_comment']))
    {
        $comment_id = $_GET['edit_comment'];
        $query_edit = "SELECT * FROM comments WHERE comment_id='$comment_id'";
        $query_edit_result = mysqli_query($connection,$query_edit);
        if($query_edit_result)
        {
            while($row=mysqli_fetch_assoc($query_edit_result))
            {
                $comment_post_id = $row['comment_post_id'];
                $comment_author = $row['comment_author'];
                $comment_content = $row['comment_content'];
                $comment_status = $row['comment_status'];
                $comment_date = $row['comment_date'];

                $query_post = "SELECT * FROM posts WHERE post_id='$comment_post_id'";
                $result_post = mysqli_query($connection,$query_post);
                if($result_post)
                {
                    while($row=mysqli_fetch_assoc($result_post))
                    {
                        $post_title = $row['post_title'];
                        echo "<td>$post_title</td>";
                    }
                }
                else
                {
                    die("Query is Wrong".mysqli_error(($connection)));
                }

                echo "
                    <form method='post'>
                        <fieldset>
                            <legend>Edit Comment</legend>
                            Post Title: <br>
                            <input type='text' name='postTitle' value='$post_title' readonly><br><br>
                            Comment Author: <br>
                            <input type='text' name='commentAuthor' readonly value='$comment_author'><br><br>
                            Comment Content: <br>
                            <input type='text' name='commentContent' value='$comment_content'><br><br>
                            Comment Status: <br>
                            <input type='text' name='commentStatus' readonly value='$comment_status'><br><br>
                            Comment Date: <br>
                            <input type='date' name='commentDate' value='$comment_date'><br><br>
                            <input type='submit' name='updateComment' class='btn btn-primary' value='Update'>
                        </fieldset>
                    </form>
                ";
            }
        }
        else
        {
            die("Edit Query is Wrong".mysqli_error(($connection)));
        }
    }
    if(isset($_POST['updateComment']))
    {
        $comment_id = $_GET['edit_comment'];
        $updated_comment_author = $_POST['commentAuthor'];
        $updated_comment_content = $_POST['commentContent'];
        $updated_comment_status = $_POST['commentStatus'];
        $updated_comment_date = $_POST['commentDate'];
        $query_update = "UPDATE comments SET comment_author='$updated_comment_author',comment_content='$updated_comment_content',comment_status='$updated_comment_status',comment_date='$updated_comment_date' WHERE comment_id='$comment_id'";
        $result_update = mysqli_query($connection,$query_update);
        if($result_update)
        {
            echo "Updated Successfully!";
            header("Location:view_comment.php");
        }
        else
        {
            die("Update Query is Wrong".mysqli_error(($connection)));
        }
    }
}

//edit posts

function edit_posts()
{
    global $connection;
    $temp;
    if(isset($_GET['edit_post']))
    {
        $post_id = $_GET['edit_post'];
        $query_edit = "SELECT * FROM posts WHERE post_id='$post_id'";
        $query_edit_result = mysqli_query($connection,$query_edit);
        if($query_edit_result)
        {
            while($row=mysqli_fetch_assoc($query_edit_result))
            {
                $post_cat_id = $row['post_category_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $temp=$post_image;
                $post_content = $row['post_content'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_status = $row['post_status'];
                echo "
                    <form method='post' enctype='multipart/form-data'>
                        <fieldset>
                            <legend>Edit Post</legend>
                            Category: <br>
                            <select name='catTitle'>";                 
                                 $query_cat = "SELECT * FROM categories";
                                $result_cat = mysqli_query($connection,$query_cat);
                                if($result_cat)
                                {        
                                    while($row=mysqli_fetch_assoc($result_cat))
                                    {
                                        $cat_id = $row['cat_id'];
                                        $cat_title = $row['cat_title'];
                                        echo "
                                            <option value='$cat_id'>$cat_title</option><br>";
                                       }
                                   }
                                
                        echo "</select>
                            <br>
                            Post Title: <br>
                            <input type='text' name='postTitle' value='$post_title'><br><br>
                            Post Author: <br>
                            <input type='text' name='postAuthor' value='$post_author' readonly><br><br>
                            Post Date: <br>
                            <input type='date' name='postDate' value='$post_date'><br><br>
                            Post Image: <br>
                            <img src='admin_images/$post_image' height='100px' width='100px'><br><br>
                            <input type='file' accept='image/*' name='postImage'><br>
                            Post Content: <br>
                            <input type='text' name='postContent' value='$post_content'><br><br>
                            Post Tags: <br>
                            <input type='text' name='postTags' value='$post_tags'><br><br>
                            Comment Count: <br>
                            <input type='number' name='commentCount' value='$post_comment_count' readonly><br><br>
                            Post Status: <br>
                            <input type='text' name='postStatus' value='$post_status' readonly><br>
                            <br>
                            <input type='submit' name='updatePost' class='btn btn-primary' value='Update'>
                        </fieldset>
                    </form>
                ";
            }
        }
        else
        {
            die("Edit Query is Wrong".mysqli_error(($connection)));
        }
    }
    if(isset($_POST['updatePost']))
    {
        $post_id = $_GET['edit_post'];
        $updated_post_cat_id = $_POST['catTitle'];
        $updated_post_title = $_POST['postTitle'];
        $updated_post_author = $_POST['postAuthor'];
        $updated_post_date = $_POST['postDate'];

        //$updated_post_image = $_POST['postImage'];
        $post_image = $_FILES['postImage']['name'];

        $post_image_name =  $updated_post_title. $post_id. $post_image;
        $post_image_temp = $_FILES['postImage']['tmp_name'];
        move_uploaded_file($post_image_temp, "../admin/admin_images/$post_image_name");

        $updated_post_content = $_POST['postContent'];
        $updated_post_tags = $_POST['postTags'];
        $updated_post_comment_count = $_POST['commentCount'];
        $updated_post_status = $_POST['postStatus'];
        if(empty($post_image))
        {
            $post_image_name=$temp;
        }
        $query_update = "UPDATE posts SET post_category_id='$updated_post_cat_id',post_title='$updated_post_title',post_author='$updated_post_author',post_date='$updated_post_date',post_image='$post_image_name',post_content='$updated_post_content',post_tags='$updated_post_tags',post_comment_count='$updated_post_comment_count',post_status='$updated_post_status' WHERE post_id='$post_id'";
        $result_update = mysqli_query($connection,$query_update);
        if($result_update)
        {
            echo "Updated Successfully!";
            header("Location:view_post.php");
        }
        else
        {
            die("Update Query is Wrong".mysqli_error(($connection)));
        }
    }
}

//edit user

function edit_user()
{
    global $connection;
    $temp;
    if(isset($_GET['edit_user']))
    {
        $user_id = $_GET['edit_user'];
        $query_edit = "SELECT * FROM users WHERE user_id='$user_id'";
        $query_edit_result = mysqli_query($connection,$query_edit);
        if($query_edit_result)
        {
            while($row=mysqli_fetch_assoc($query_edit_result))
            {
                $username = $row['username'];
                $user_password = $row['user_password'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_email = $row['user_email'];
                $user_image = $row['user_image'];
                $temp=$user_image;
                $user_role = $row['user_role'];
                $user_rand_salt = $row['randSalt'];
                $user_token = $row['token'];
                echo "
                    <form method='post'>
                        <fieldset>
                            <legend>Edit User</legend>
                            Username: <br>
                            <input type='text' name='userName' value='$username'><br><br>
                            Password: <br>
                            <input type='password' name='userPassword' value='$user_password'><br><br>
                            First Name: <br>
                            <input type='text' name='firstName' value='$user_firstname'><br><br>
                            Last Name: <br>
                            <input type='text' name='lastName' value='$user_lastname'><br><br>
                            User Email: <br>
                            <input type='text' name='userEmail' value='$user_email'><br><br>
                            User Image: <br>
                            <img src='admin_images/$user_image' height='100px' width='100px'><br><br>
                            <input type='file' name='userImage'><br>
                            User Role: <br>
                            <input type='text' name='userRole' value='$user_role'><br><br>
                            Rand Salt: <br>
                            <input type='text' name='randSalt' value='$user_rand_salt'><br><br>
                            Token: <br>
                            <input type='text' name='userToken' value='$user_token'><br><br>
                            <br>
                            <input type='submit' name='updateUser' class='btn btn-primary' value='Update'>
                        </fieldset>
                    </form>
                ";
            }
        }
        else
        {
            die("Edit Query is Wrong".mysqli_error(($connection)));
        }
    }
    if(isset($_POST['updateUser']))
    {
        $user_id = $_GET['edit_user'];
        $updated_username = $_POST['userName'];
        $updated_user_password = $_POST['userPassword'];
        $updated_user_firstname = $_POST['firstName'];
        $updated_user_lastname = $_POST['lastName'];
        $updated_user_email = $_POST['userEmail'];
        $updated_user_image = $_POST['userImage'];
        $updated_user_role = $_POST['userRole'];
        $updated_user_rand_salt = $_POST['randSalt'];
        $updated_user_token = $_POST['userToken'];
        if(empty($updated_user_image))
        {
            $updated_post_image=$temp;
        }
        $query_update = "UPDATE users SET username='$updated_username',user_password='$updated_user_password',user_firstname='$updated_user_firstname',user_lastname='$updated_user_lastname',user_email='$updated_user_email',user_image='$updated_user_image',user_role='$updated_user_role',randSalt='$updated_user_rand_salt',token='$updated_user_token' WHERE user_id='$user_id'";
        $result_update = mysqli_query($connection,$query_update);
        if($result_update)
        {
            echo "Updated Successfully!";
            header("Location:view_user.php");
        }
        else
        {
            die("Update Query is Wrong".mysqli_error(($connection)));
        }
    }
}




//profile.php view profile



function profile()
{
    global $connection;
    $username = $_SESSION['username_backend'];
    $id = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE username='$username' AND user_id ='$id' " ;
    $result = mysqli_query($connection,$query);
    if($result)
    {
        $user_pic;
        $user_firstname = $_SESSION['user_firstname'];
        $user_lastname = $_SESSION['user_lastname'];
        $user_email = $_SESSION['user_email'];
        $username = $_SESSION['username_backend'];
        while($row=mysqli_fetch_assoc($result))
        {
            $user_pic = $row['user_image'];
        }
        
            echo "
                <div align='center'>
                    <img src='admin_images/$user_pic' height='300px' alt='No Profile Picture Please Update Your Profile' width='300px;' style='border-radius: 100%;'>
                </div>
                <br><br>
                ";
        echo "
            <div align='center'>
                <h4>First name:$user_firstname</h4>    
                <br>
                <h4>Last name:$user_lastname</h4>
                <br>
                <h4>Email:$user_email</h4>
                <br>
                <h4>Username:$username</h4>
                <br>
                <a type='submit' class='btn btn-primary' name='edit' href='temp_profile.php'>Edit Profile</a>
            </div>
            ";
    }
}




//temp_profile



function update_profile()
{
    global $connection;
    $id = $_SESSION['user_id'];
    $username = $_SESSION['username_backend'];
    $query = "SELECT * FROM users WHERE username='$username' AND user_id ='$id'" ;
    $result = mysqli_query($connection,$query);
    if($result)
    {
        $user_pic=null;
        $user_firstname = $_SESSION['user_firstname'];
        $user_lastname = $_SESSION['user_lastname'];
        $user_email = $_SESSION['user_email'];
        $user_id = $_SESSION['user_id'];

        while($row=mysqli_fetch_assoc($result))
            {
                $user_pic = $row['user_image'];
            }
        echo "
            <div align='center'>
                <img src='admin_images/$user_pic' height='300px' alt='Your Profile Will be Updated Soon' width='300px;' style='border-radius: 100%;'>
            </div>
            ";
        echo "
            <div class='well'>
                <form method='post' enctype='multipart/form-data'>
                    <div class='form-group' align='center'>
                        First name:
                        <input type='text' name='firstName' value='$user_firstname'><br><br>
                        Last name:
                        <input type='text' name='lastName' value='$user_lastname'><br><br>
                        Email:
                        <input type='email' name='userEmail' value='$user_email' readonly><br><br>
                        Username:
                        <input type='text' name='userName' value='$username' readonly><br><br>
                        Profile picture:
                        <input type='file' accept='image/*' name='userPic'><br><br>
                        <br><br>
                        <input type='submit' name='update' value='Change' class='btn btn-primary'>
                    </div>
                </form>
            </div>
            ";
            if(isset($_POST['update']))
            {
                $updated_user_firstname = $_POST['firstName'];
                $updated_user_lastname = $_POST['lastName'];
                $updated_username = $_POST['userName'];
                //$updated_profile_pic = $_POST['userPic'];

                //file upload
               // $post_images = $_POST['userPic'];
                $post_image = $_FILES['userPic']['name'];

                $post_image_name =  $updated_user_firstname. $user_id. $post_image;
                $post_image_temp = $_FILES['userPic']['tmp_name'];
                move_uploaded_file($post_image_temp, "admin_images/$post_image_name");

                
                //end file upload
                //$updated_profile_pic = $_FILES['image']['name'];
                if(empty($post_image))
                {
                    $post_image_name = $user_pic;
                }
                 $post_image_name;
                $query_update = "UPDATE users SET user_firstname='$updated_user_firstname', user_lastname='$updated_user_lastname',username='$updated_username', user_image='$post_image_name' WHERE user_id='$user_id'";
                $result_update = mysqli_query($connection,$query_update);
                if($result_update)
                {
                    $_SESSION['user_firstname'] = $updated_user_firstname;
                    $_SESSION['user_lastname'] = $updated_user_lastname;
                    header("Location: profile.php");
                }
                else
                {
                    die("Error in blah query!".mysqli_error($connection));
                }
            }
        }

}


//view comments

function view_comments()
{
    global $connection;
    $username=$_SESSION['username_backend'];
    $query_show_comments = "SELECT * FROM comments WHERE comment_post_id IN(SELECT post_id FROM posts WHERE post_author='$username')";
    $result_show_comments = mysqli_query($connection,$query_show_comments);
    $toggle;
    if($result_show_comments)
    {
        $i=1;
        while($row=mysqli_fetch_assoc($result_show_comments))
        {
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment_content = $row['comment_content'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];
            if($comment_status == "Approve")
            {
                $toggle = "Unapprove";
            }
            else if($comment_status == "Unapprove")
            {
                $toggle = "Approve";
            }
            echo "
                <tbody style='text-align: center;'>
                    <tr>
                        <td>$i</td>";
                        $query_post = "SELECT * FROM posts WHERE post_id='$comment_post_id'";
                        $result_post = mysqli_query($connection,$query_post);
                        if($result_post)
                        {
                            while($row=mysqli_fetch_assoc($result_post))
                            {
                                $post_title = $row['post_title'];
                                echo "<td>$post_title</td>";
                            }
                        }
                        else
                        {
                            die("Query is Wrong".mysqli_error(($connection)));
                        }
            echo "
                        <td>$comment_author</td>
                        <td>$comment_content</td>
                        <td><a href='app_dis_comment.php?com_id=$comment_id&toggle=$comment_status'>$toggle</a></td>
                        <td>$comment_date</td>
                        <td><a href='edit_comment.php?edit_comment=$comment_id'>Edit</a></td>
                        <td><a href='view_comment.php?delete_comment=$comment_id'>Delete</a></td>


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
}


// delete comment


function delete_comment()
{
    global $connection;
    if(isset($_GET['delete_comment']))
    {
        $delete_id = $_GET['delete_comment'];
        $query_delete = "DELETE FROM comments WHERE comment_id='$delete_id'";
        $query_delete_result = mysqli_query($connection,$query_delete);
        if($query_delete_result)
        {
            // echo "<script>

            //     alert('Comment deleted!');
            
            // </script>";
            header("Location:view_comment.php");
        }
        else
        {
            die("Delete Query is Wrong".mysqli_error(($connection)));
        }
    }
}


// view post 

function view_posts()
{
    global $connection;
    $username=$_SESSION['username_backend'];
    $query_show_posts = "SELECT * FROM posts WHERE post_author='$username'";
    $result_show_posts = mysqli_query($connection,$query_show_posts);
    if($result_show_posts)
    {
        $toggle='';
        $i=1;
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
            $post_comment_count;
            $post_status = $row['post_status'];
            if($post_status == "Approve")
            {
                $toggle = "Unapprove";
            }
            else if($post_status == "Unapprove")
            {
                $toggle = "Approve";
            }
            echo "
                <tbody style='text-align: center;'>
                    <tr>
                        <td>$i</td>";
                        $query_cat_select = "SELECT * FROM categories WHERE cat_id='$post_cat_id'";
                        $result_cat_select = mysqli_query($connection,$query_cat_select);
                        $cat_title;
                        if($result_cat_select)
                        {
                            while($row=mysqli_fetch_assoc($result_cat_select))
                            {
                                $cat_title = $row['cat_title'];
                            }
                        }
                        else
                        {
                            die('Query is Wrong'.mysqli_error(($connection)));
                        }

                        $query_comment = "SELECT * FROM comments WHERE comment_post_id='$post_id'";
                        $result_comment = mysqli_query($connection,$query_comment);
                        if($result_comment)
                        {
                            $post_comment_count = mysqli_num_rows($result_comment);
                            $query = "UPDATE posts SET post_comment_count=$post_comment_count WHERE post_id=$post_id";
                            $result = mysqli_query($connection,$query);
                            if($result)
                            {
                                //echo "Successful!"
                            }
                            else
                            {
                                die("Query is Wrong".mysqli_error(($connection)));
                            }
                        }
                        else
                        {
                            die('Query is Wrong'.mysqli_error(($connection)));
                        }
            echo "
                        <td>$cat_title</td>
                        <td>$post_title</td>
                        <td>$post_author</td>
                        <td>$post_date</td>
                        <td><img src='admin_images/$post_image' height='100px' width='100px'></td>
                        <td>$post_content</td>
                        <td>$post_tags</td>
                        <td>$post_comment_count</td>
                        <td>$post_status</td>
                        <td><a href='app_dis_post.php?toggle=$post_status&postID=$post_id'>$toggle</a></td>
                        <td><a href='edit_post.php?edit_post=$post_id'>Edit</a></td>
                        <td><a href='view_post.php?delete_post=$post_id'>Delete</a></td>
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
}

//delete posts

function delete_posts()
{
    global $connection;
    if(isset($_GET['delete_post']))
    {
        $delete_id = $_GET['delete_post'];
        $query_delete = "DELETE FROM posts WHERE post_id='$delete_id'";
        $query_delete_result = mysqli_query($connection,$query_delete);
        if($query_delete_result)
        {
            // echo "<script>

            //     alert('Category deleted!');
            
            // </script>";
            header("Location:view_post.php");
        }
        else
        {
            die("Delete Query is Wrong".mysqli_error(($connection)));
        }
    }
}

?>