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
 * @var string $perm_tree
 * @var string $role_tree
 */

echo "<link rel='stylesheet' href='" . base_url() . "assets/third_party/jstree/themes/default/style.min.css'/>";
echo "<script src='" . base_url() . "assets/js/jquery.js'></script>";
echo "<script src='" . base_url() . "assets/third_party/jstree/jstree.min.js'></script>";
echo "<script src='" . base_url() . "application/modules/rbac/views/js/assign_role_perm.js'></script>";

echo 'Roles:';
echo '<div id="role_tree">';
print $role_tree;
echo '</div>';

echo '</br>';
echo 'Permissions:';
echo '<div id="perm_tree">';
print $perm_tree;
echo '</div>';

echo '</br>';
echo form_button('btn_assign', 'Assign', "id='btn_assign'");
echo form_button('btn_unassign', 'Unassign', "id='btn_unassign'");