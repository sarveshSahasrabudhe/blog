<?php
        $connection=mysqli_connect('localhost','root','','blog');
        if($connection)
        {
            #echo "Connection successful!";
        }
        else
        {
            echo "Error".mysqli_error($connection);
        }
?>