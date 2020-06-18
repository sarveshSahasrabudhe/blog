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
                        <a href='index.php'>Home</a>
                    </li>
                    <!-- <li>
                        <a href='index.php'>My Timeline</a>
                    </li>
                    <li>
                        <a href='feed.php'>My Feed</a>
                    </li> -->
                <?php
                    if($_SESSION['username_backend'] == null)
                    {
                        echo "
                            <li>
                                <a href='login_register/login.php'>Login</a>
                            </li>
                            <li>
                                <a href='login_register/register.php'>Register</a>
                            </li>
                            ";
                    }
                    else 
                    {
                        if($_SESSION['user_email'] == 'super@gmail.com' && $_SESSION['user_id'] == 4 )
                        {
                            echo "
                            <li>
                                <a href='superadmin/index.php'>Dashboard</a>
                            </li>
                            <li>
                            <a href='feed.php'>My Feed</a>
                          </li>
                              "; 
                        }   
                        else                   
                        echo "
                        <li>
                            <a href='admin/index.php'>Dashboard</a>
                        </li>
                        <li>
                        <a href='feed.php'>My Feed</a>
                      </li>
                          "; 
                    }
                ?>
                </ul>
                <?php 
                    if($_SESSION['username_backend'] != null)
                    {
                ?>

                <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php echo $_SESSION['user_firstname']; ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="admin/profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="login_register/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
                    <?php } ?>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>