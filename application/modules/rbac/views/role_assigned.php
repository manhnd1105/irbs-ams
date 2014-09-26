<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 9/1/14
 * Time: 3:07 PM
 */
/**
 * @var array $role_list array of roles assigned to an account
 * @var $back_to_main string
 */
echo 'Assigned roles:';
echo '</br>';
if ($role_list)
{
    print($role_list);
} else
{
    echo 'There has not any role assigned to this account';
}

echo '</br>';
echo anchor($back_to_main, 'Back to main');