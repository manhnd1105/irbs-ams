<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 9/1/14
 * Time: 3:07 PM
 */
/**
 * @var array $perm_list array of permissions assigned to a role
 * @var $back_to_main string
 */
echo 'Assigned perms:';
echo '</br>';
if ($perm_list)
{
    print($perm_list);
} else
{
    echo 'There has not any permissions assigned to this role';
}

echo '</br>';
echo anchor($back_to_main, 'Back to main');