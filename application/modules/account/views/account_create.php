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

echo '<div class="row">';
echo '<div  class="col-sm-4">';
echo '</div >';

echo '<div  class="col-sm-4">';
echo form_open('account/account_controller/create',"class='form-horizontal'");

echo form_fieldset('Detail information');
echo '<div class="form-group-sm">';
echo form_label('Username');
echo form_input('username','',"class='form-control'","id=''");
echo form_error('username');
echo '</div>';

echo '<div class="form-group-sm">';
echo form_label('Password');
echo form_input('password','',"class='form-control'","id=''");
echo form_error('password');
echo '</div>';

echo '<div class="form-group-sm">';
echo form_label('Email');
echo form_input('email','',"class='form-control'","id=''");
echo form_error('email');
echo '</div>';

//echo '<div class="form-group">';
//echo form_label('Account Name');
//echo form_input('account_name','',"class='form-control'","id=''");
//echo form_error('account_name');
//echo '</div>';
//
//echo '<div class="form-group">';
//echo form_label('Staff Name');
//echo form_input('staff_name','',"class='form-control'","id=''");
//echo form_error('staff_name');
//echo '</div>';
//
//echo '<div class="form-group">';
//echo form_label('Password');
//echo form_input('password','',"class='form-control'","id=''");
//echo form_error('password');
//echo '</div>';
//
//echo '<div class="form-group">';
//echo form_label('Address');
//echo form_input('address','',"class='form-control'","id=''");
//echo form_error('address');
//echo '</div>';
echo form_fieldset_close();

//echo form_fieldset('Roles');
//echo "<div id='role_tree'>";
//print $role_tree;
//echo "</div>";

echo form_fieldset_close();
echo form_button('btn_create', 'Sing up',"class='btn btn-success'");
echo  '<br/>';
echo '<img src="..." alt="..." class="img-circle">';
echo anchor('','Use existing Google account');
echo  '<br/>';
echo '<img src="..." alt="..." class="img-circle">';
echo anchor('','Use existing Facebook account');

echo '</div >';
echo '<div  class="col-sm-4">';
echo '</div >';
echo '</div>';

