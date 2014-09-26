<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 8/29/14
 * Time: 2:56 PM
 */
//echo 'This is side menu';
echo '<p>' . anchor('account/account_controller', 'Manage Inkiu accounts') . '</p>';
echo '<p>' . anchor('authentication/authentication_controller/', 'Authentication') . '</p>';
echo '<p>' . anchor('rbac/perm_controller/', 'Manage permissions') . '</p>';
echo '<p>' . anchor('rbac/role_controller/', 'Manage roles') . '</p>';
echo '<p>' . anchor('http://inkiu.vn/irbs-dms/index.php/api/api_controller/order', 'Access to external system: get list orders') . '</p>';
echo '<p>' . anchor('/rbac/rbac_controller/view_assign_role_perm', 'Assign permissions to role') . '</p>';
echo '<p>' . anchor('/rbac/rbac_controller/view_assign_acc_role', 'Assign roles to account') . '</p>';
echo '<p>' . anchor('/rbac/perm_controller/reset', 'Reset all permissions') . '</p>';
echo '<p>' . anchor('/rbac/perm_controller/make_sample_perms', 'Make sample permissions set') . '</p>';
echo '<p>' . anchor('/rbac/role_controller/reset', 'Reset all roles') . '</p>';
echo '<p>' . anchor('/rbac/role_controller/make_sample_roles', 'Make sample roles set') . '</p>';
echo '<p>' . anchor('/rbac/rbac_controller/set_unauthorized_access', 'Setup unauthorized permissions') . '</p>';
echo '<p>' . anchor('/client/client_controller/', 'Make request to api server') . '</p>';