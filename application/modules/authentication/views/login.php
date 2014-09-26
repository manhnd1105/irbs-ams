<?php
/** @var $module_name string */
/** @var $controller_name string */
/** @var $action string */
echo form_open($module_name . '/' . $controller_name . '/' . $action);
echo '<p>';
echo form_label('Account Name');
echo form_input('acc_name', 'manhnd');
echo form_error('acc_name');
echo '</p>';

echo '<p>';
echo form_label('Password');
echo form_password('password', '123456');
echo form_error('password');
echo '</p>';

echo form_submit('submit', 'Confirm');

