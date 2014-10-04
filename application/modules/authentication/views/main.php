<?php
///**
// * Created by PhpStorm.
// * User: dell
// * Date: 7/24/14
// * Time: 9:52 AM
// */
///**
// * @var $acc_name string
// */
//
//echo '</br>';
//
//if ($acc_name) {
//    echo 'Hello, ' . $acc_name;
//    echo '</br>';
//    echo anchor('authentication/authentication_controller/logout', 'Log out');
//} else {
//    echo anchor('authentication/authentication_controller/login', 'Log in');
//}
//echo '</br>';
//echo anchor('home/home_controller/', 'Main menu');



echo '<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">';
    echo '<div class="container-fluid">';
        echo ' <div class="navbar-header">';
            echo '<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">';
                echo ' <span class="sr-only">Toggle navigation</span>';
                echo '   <span class="icon-bar"></span>';
                echo '<span class="icon-bar"></span>';
                echo '<span class="icon-bar"></span>';
                echo '</button>';
            echo '<a class="navbar-brand" href="#">Inkiu Remove Background</a>';
            echo '</div>';
        echo '<div class="navbar-collapse collapse">';
            echo '<ul class="nav navbar-nav navbar-right">';
                echo '<li><a href="#">Dashboard</a></li>';

                echo '<li><a href="#">Profile</a></li>';


                echo '<li style="width: 200px">';
                    if ($acc_name==null) {
                        echo anchor('authentication/authentication_controller/login', 'Log in');
                    } else {
                        echo 'Hello,' . $acc_name; echo anchor('authentication/authentication_controller/logout', 'Log out');
                    }
                    echo   '</li>';

                echo '</ul>';
            echo '<form class="navbar-form navbar-right">';
                echo '<input type="text" class="form-control" placeholder="Search...">';
                echo '</form>';
            echo '</div>';
        echo '</div>';
    echo '</div>';


