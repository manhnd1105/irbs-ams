<script type="text/javascript">
    base_url = '<?=base_url()?>';
</script>
<?php
/**
 * @var $id int The id of this account
 * @var $info array of string Basic personal information (except roles)
 * @var $role_tree string Html format of role tree nodes
 */

echo "<link rel='stylesheet' href='" . base_url() . "assets/third_party/jstree/themes/default/style.min.css'/>";
echo "<script src='" . base_url() . "assets/js/jquery.js'></script>";
echo "<script src='" . base_url() . "assets/third_party/jstree/jstree.min.js'></script>";
echo "<script src='" . base_url() . "application/modules/account/views/js/role_tree.js'></script>";

echo form_open('account/account_controller/update');
echo form_hidden('id', $info['id']);
echo form_fieldset('Information');
echo '<p>';
echo form_label('Account Name');
echo form_input('account_name', $info['account_name']);
echo form_error('account_name');
echo '</p>';
echo '<p>';
echo form_label('Staff Name');
echo form_input('staff_name', $info['staff_name']);
echo form_error('staff_name');
echo '</p>';
echo '<p>';
echo form_label('Password');
echo form_password('password', $info['password']);
echo form_error('password');
echo '</p>';
echo '<p>';
echo form_label('Address');
echo form_input('address', $info['address']);

echo form_fieldset('Assigned roles');
echo "<div id='role_tree'>";
print $role_tree;
echo "</div>";
echo form_fieldset_close();

echo form_button('btn_update', 'Update', "id='btn_update'");


