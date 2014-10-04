<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 8/29/14
 * Time: 2:57 PM
 */

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

if (!isset($acc_name)) {
    echo '<li>'.anchor('account/account_controller/view_create', 'Sign up').'</li>';
    echo '<li>'.anchor('authentication/authentication_controller/view_login', 'Log in').'</li>';
} else {
    echo '<li><a href="#">
<span class="badge pull-right">42</span>
Message
</a></li>';
    echo '<li><a href="#">Settings</a></li>';
    echo '<li><a href="#">Profile</a></li>';
    echo '<li>';
    echo 'Hello,' . $acc_name; echo anchor('authentication/authentication_controller/logout', 'Log out');
    echo '</li>';
}
echo   '';

echo '</ul>';
echo '</ul>';
echo '<form class="navbar-form navbar-right">';
echo '<input type="text" class="form-control" placeholder="Search...">';
echo '</form>';
echo '</div>';
echo '</div>';
echo '</div>';






















