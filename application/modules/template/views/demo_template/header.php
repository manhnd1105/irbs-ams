<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<link rel="stylesheet" href="<?php echo base_url() . "assets/css/bootstrap.css"; ?>">
<link rel="stylesheet" href="<?php echo base_url() . "assets/css/admin_template/sb_admin.css"; ?>">
<link rel="stylesheet" href="<?php echo base_url() . "assets/font-awesome-4.1.0/css/font-awesome.css"; ?>">
<script type="text/javascript" src="<?php echo base_url() . "assets/js/jquery.js"; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . "assets/js/bootstrap.js"; ?>"></script>

<!--Navigation-->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"><i class="glyphicon glyphicon-home"></i> Inkiu Remove Background</a>
    </div>
    <!--End nav bar-header-->

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-envelope fa-fw"></i> <span class="badge"> 40</span><i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-messages">
                <li>
                    <a href="#">
                        <div>
                            <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                        </div>
                        <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                    </a>
                </li>
            </ul>
            <!-- /.dropdown-messages -->
        </li>
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-bell fa-fw"></i> <span class="badge">42</span> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-alerts">
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-users fa-fw"></i> 3 new notifications
                            <span class="pull-right text-muted small">2 days ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>

            </ul>
            <!-- /.dropdown-alerts -->
        </li>
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <?php
            $acc_name = $this->session->userdata('acc_name');

            echo '<ul class="dropdown-menu dropdown-user">';
            echo '<li>';
            echo '<a href="#">Hello, ' . $acc_name . '</a>';
            echo '</li>';
            echo '<li><a href="#"><i class="fa fa-gear fa-fw"></i>Profile</a>';
            echo '</li>';
            echo '<li>';
            echo anchor('authentication/authentication_controller/logout', 'Log out');
            echo '</li>';
            echo '<li class="divider"></li>';
            echo '</ul>';
            ?>
        </li>
    </ul>
    <!--End notification - user setting nav-->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <?php $this->load->view('side_menu'); ?>
            </ul>
        </div>
    </div>
    <!-- End side-menu -->
</nav>
