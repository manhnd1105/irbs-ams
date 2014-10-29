<script type="text/javascript">
    base_url = '<?=base_url()?>';
</script>
<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 8/29/14
 * Time: 5:53 PM
 */

/**
 * @var string $role_tree html format of hierarchical role nodes
 * @var array $acc_list array of information of accounts
 */
echo "<link rel='stylesheet' href='" . base_url() . "assets/third_party/jstree/themes/default/style.min.css'/>";
echo "<script src='" . base_url() . "assets/js/jquery.js'></script>";
echo "<script src='" . base_url() . "assets/third_party/jstree/jstree.min.js'></script>";
echo "<script src='" . base_url() . "application/modules/rbac/views/js/assign_acc_role.js'></script>";

echo 'Accounts:';
//echo '<div id="acc_list">';
//foreach ($acc_list as $row)
//{
//    echo '<p>' . $row . '</p>';
//}
//echo '</div>';
//echo form_hidden('selected_acc', '1');
echo form_hidden('selected_acc', $acc_id);

echo 'Roles:';
echo '<div id="role_tree">';
print $role_tree;
echo '</div>';


echo '</br>';
echo form_button('btn_assign', 'Assign', "id='btn_assign'");
echo form_button('btn_unassign', 'Unassign', "id='btn_unassign'");
//echo "<div id='event_result'></div>";