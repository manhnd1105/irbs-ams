<script type="text/javascript">
    base_url = '<?=base_url()?>';
</script>
<?php
/**
 * @var $id int The id of this account
 * @var $info array of string Basic personal information (except roles)
 * @var $role_tree string Html format of role tree nodes
 */

echo "<link rel='stylesheet' href='" . base_url() . "dist/themes/default/style.min.css'/>";
echo "<script src='" . base_url() . "dist/libs/jquery.js'></script>";
echo "<script src='" . base_url() . "dist/jstree.min.js'></script>";
echo "<script src='" . base_url() . "application/modules/account/views/js/role_tree.js'></script>";

echo form_open('account/account_controller/update');
echo form_hidden('id', $info['id']);
echo form_fieldset('Information');
echo '<div class="form-group">';
echo form_label('Username');
echo form_input('account_name', $info['account_name'],"class='form-control'","id=''");
echo form_error('account_name');
echo '</div>';
echo '<div class="form-group">';
echo form_label('Staff Name');
echo form_input('staff_name', $info['staff_name'],"class='form-control'","id=''");
echo form_error('staff_name');
echo '</div>';
echo '<div class="form-group">';
echo form_label('Password');
echo form_password('password', $info['password'],"class='form-control'","id=''");
echo form_error('password');
echo '</div>';
echo '<div class="form-group">';
echo form_label('Address');
echo form_input('address', $info['address'],"class='form-control'","id=''");
echo '</div>';
echo form_fieldset('Assigned roles');
echo "<div id='role_tree'>";
print $role_tree;
echo "</div>";
echo form_fieldset_close();

echo form_button('btn_update', 'Update',"class='btn btn-success'");echo '      ';
echo form_button('btn_cancel', 'Cancel',"class='btn btn-success'");



