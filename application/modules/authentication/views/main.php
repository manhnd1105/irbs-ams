<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 7/24/14
 * Time: 9:52 AM
 */
/**
 * @var $acc_name string
 */
echo 'This is authentication main page';
echo '</br>';

if ($acc_name) {
    echo 'Hello, ' . $acc_name;
    echo '</br>';
    echo anchor('authentication/authentication_controller/logout', 'Log out');
} else {
    echo anchor('authentication/authentication_controller/login', 'Log in');
}
echo '</br>';
echo anchor('home/home_controller/', 'Main menu');