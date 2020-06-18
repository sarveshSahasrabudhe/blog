 <!-- Navigation -->
 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- <a class="navbar-brand" href="index.php">My Timeline</a> -->
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href='index.php'>Dashboard</a>
                    </li>
                    <li>
                        <a href='timeline.php'>My Timeline</a>
                    </li>
                    <li>
                        <a href='feed.php'>My Feed</a>
                    </li>
                <?php
                    // if($_SESSION['username_backend'] == null)
                    // {
                    //     echo "
                    //         <li>
                    //             <a href='login_register/login.php'>Login</a>
                    //         </li>
                    //         <li>
                    //             <a href='login_register/register.php'>Register</a>
                    //         </li>
                    //         ";
                    // }
                ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>