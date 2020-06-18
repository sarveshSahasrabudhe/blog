<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php echo $_SESSION['user_firstname']; ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../login_register/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="../index.php"><i class="fa fa-fw fa-dashboard"></i>My Timeline</a>
                    </li>
                    <li>
                        <a href="../feed.php"><i class="fa fa-fw fa-dashboard"></i>My Feed</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#post"><i class="fa fa-fw fa-arrows-v"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="post" class="collapse">
                            <li>
                                <a href="add_post.php">Add Post</a>
                            </li>
                            <li>
                                <a href="view_post.php">View Posts</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="view_comment.php"><i class="fa fa-fw fa-bar-chart-o"></i>Comments</a>
                    </li>
                    <li>
                        <a href="categories.php"><i class="fa fa-fw fa-table"></i>Categories</a>
                    </li>
                    <!-- <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> User <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="add_user.php">Add user</a>
                            </li>
                            <li>
                                <a href="view_user.php">View users</a>
                            </li>
                        </ul>
                    </li> -->
                    <!-- <li>
                        <a href="login.php"><i class="fa fa-fw fa-desktop"></i>Login</a>
                    </li>
                    <li>
                        <a href="register.php"><i class="fa fa-fw fa-desktop"></i>Register</a>
                    </li> -->
                    <li>
                        <a href="profile.php"><i class="fa fa-fw fa-desktop"></i>Profile</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>