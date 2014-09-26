<script type="text/javascript">
    base_url = '<?=base_url()?>';
</script>

<?php
/**
 * @var string $role_tree html format of tree of role nodes
 */

echo "<link rel='stylesheet' href='" . base_url() . "dist/themes/default/style.min.css'/>";
echo "<script src='" . base_url() . "dist/libs/jquery.js'></script>";
echo "<script src='" . base_url() . "dist/jstree.min.js'></script>";
echo "<script src='" . base_url() . "application/modules/account/views/js/role_tree.js'></script>";

echo form_open('account/account_controller/create');

echo form_fieldset('Detail information');
echo '<p>';
echo form_label('Account Name');
echo form_input('account_name');
echo form_error('account_name');
echo '</p>';

echo '<p>';
echo form_label('Staff Name');
echo form_input('staff_name');
echo form_error('staff_name');
echo '</p>';

echo '<p>';
echo form_label('Password');
echo form_input('password');
echo form_error('password');
echo '</p>';

echo '<p>';
echo form_label('Address');
echo form_input('address');
echo form_error('address');
echo '</p>';
echo form_fieldset_close();

echo form_fieldset('Roles');
echo "<div id='role_tree'>";
print $role_tree;
echo "</div>";
echo form_fieldset_close();
echo form_button('btn_create', 'Create account', "id='btn_create'");
