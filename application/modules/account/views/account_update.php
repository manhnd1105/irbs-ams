<?php
/**
 * @var $info      array of string Basic personal information (except roles)
 * @var string $form_action
 */

echo '<div class="row">';
echo '<div  class="col-sm-4">';
echo '</div >';

echo '<div  class="col-sm-4">';
echo form_open($form_action, "class='form-horizontal'");
echo form_hidden('id', $info['id']);
echo form_fieldset('Detail information');

echo '<div class="form-group-sm">';
echo form_label('Login name');
echo form_input('account_name', $info['account_name'], "class='form-control'", "id=''");
echo form_error('account_name');
echo '</div>';

echo '<div class="form-group-sm">';
echo form_label('Full name');
echo form_input('staff_name', $info['staff_name'], "class='form-control'", "id=''");
echo form_error('staff_name');
echo '</div>';

echo '<div class="form-group-sm">';
echo form_label('Password');
echo form_input('password', $info['password'], "class='form-control'", "id=''");
echo form_error('password');
echo '</div>';

echo '<div class="form-group-sm">';
echo form_label('Email');
echo form_input('email', $info['email'], "class='form-control'", "id=''");
echo form_error('email');
echo '</div>';

echo form_fieldset_close();

echo form_submit('btn_update', 'Update', "class='btn btn-success'");

echo '</div >';

echo '<div  class="col-sm-4">';
echo '</div >';
echo '</div>';





