<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 8/29/14
 * Time: 2:56 PM
 */
//echo 'This is side menu';
//echo '<ul class="nav nav-pills nav-stacked">';
//echo '<li>' . anchor('account/account_controller', 'Manage Inkiu accounts') . '</li>';
//echo '<li>' . anchor('authentication/authentication_controller/', 'Authentication') . '</li>';
//echo '<li>' . anchor('rbac/perm_controller/', 'Manage permissions') . '</li>';
//echo '<li>' . anchor('rbac/role_controller/', 'Manage roles') . '</li>';
//echo '<li>' . anchor('http://inkiu.vn/irbs-dms/index.php/api/api_controller/order', 'Access to external system: get list orders') . '</li>';
//echo '<li>' . anchor('/rbac/rbac_controller/view_assign_role_perm', 'Assign permissions to role') . '</li>';
//echo '<li>' . anchor('/rbac/rbac_controller/view_assign_acc_role', 'Assign roles to account') . '</li>';
//echo '<li>' . anchor('/rbac/perm_controller/reset', 'Reset all permissions') . '</li>';
//echo '<li>' . anchor('/rbac/perm_controller/make_sample_perms', 'Make sample permissions set') . '</li>';
//echo '<li>'. anchor('/rbac/role_controller/reset', 'Reset all roles') . '</li>';
//echo '<li>' . anchor('/rbac/role_controller/make_sample_roles', 'Make sample roles set') . '</li>';
//echo '<li>' . anchor('/rbac/rbac_controller/set_unauthorized_access', 'Setup unauthorized permissions') . '</li>';
//echo '<li>' . anchor('/client/client_controller/', 'Make request to api server') . '</li>';
//
//echo '</ul>';


echo     '<div class="row">';
echo ' <div class="col-sm-3 col-md-2 sidebar" >';

echo '   <ul class="nav nav-pills nav-stacked">';
//echo '  <li class="active"><a href="#">Overview</a></li>';
echo '<li class="active">' . anchor('account/account_controller', 'Manage Inkiu accounts') . '</li>';
//echo '<li>' . anchor('authentication/authentication_controller/', 'Authentication') . '</li>';
echo '<li class="active">' . anchor('rbac/perm_controller/', 'Manage permissions') . '</li>';
echo '<li class="active">' . anchor('rbac/role_controller/', 'Manage roles') . '</li>';
echo '<li>' . anchor('http://inkiu.vn/irbs-dms/index.php/api/api_controller/order', 'Access to external system: get list orders') . '</li>';
echo '<li>' . anchor('/rbac/rbac_controller/view_assign_role_perm', 'Assign permissions to role') . '</li>';
echo '<li>' . anchor('/rbac/rbac_controller/view_assign_acc_role', 'Assign roles to account') . '</li>';
echo '<li>' . anchor('/rbac/perm_controller/reset', 'Reset all permissions') . '</li>';
echo '<li>' . anchor('/rbac/perm_controller/make_sample_perms', 'Make sample permissions set') . '</li>';
echo '<li>'. anchor('/rbac/role_controller/reset', 'Reset all roles') . '</li>';
echo '<li>' . anchor('/rbac/role_controller/make_sample_roles', 'Make sample roles set') . '</li>';
echo '<li>' . anchor('/rbac/rbac_controller/set_unauthorized_access', 'Setup unauthorized permissions') . '</li>';
echo '<li>' . anchor('/client/client_controller/', 'Make request to api server') . '</li>';
//
echo ' </ul>';
//echo ' <ul class="nav nav-sidebar">';
//echo ' <li><a href="">Nav item again</a></li>';
//echo '   <li><a href="">One more nav</a></li>';
//echo '  <li><a href="">Another nav item</a></li>';
//echo ' </ul>';
echo ' </div>';




















