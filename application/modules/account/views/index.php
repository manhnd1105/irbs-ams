<script type="text/javascript">
    base_url = '<?=base_url()?>';
</script>

<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 10/1/14
 * Time: 4:19 PM
 *
 * @var string $acc_tree
 */

echo "<link rel='stylesheet' href='" . base_url() . "assets/third_party/jstree/themes/default/style.min.css'/>";
echo "<script src='" . base_url() . "assets/js/jquery.js'></script>";
echo "<script src='" . base_url() . "assets/third_party/jstree/jstree.min.js'></script>";
echo "<script src='" . base_url() . "application/modules/account/views/js/acc_tree.js'></script>";

echo '<div>&nbsp;</div>';
echo '<div>&nbsp;</div>';
echo '<div>&nbsp;</div>';
echo '<div id="jstree">';
print $acc_tree;
echo '</div>';

echo form_button('btn_create', 'Create account', "id='btn_create'");
echo form_button('btn_update', 'Update account', "id='btn_update'");
echo form_button('btn_delete', 'Delete account', "id='btn_delete'");
echo form_button('btn_list_roles', 'List assigned roles', "id='btn_list_roles'");
echo form_button('btn_assign_roles', 'Assign roles', "id='btn_assign_roles'");