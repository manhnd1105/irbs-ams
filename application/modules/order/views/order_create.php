<?php
/** @var $module string */
/** @var $controller string */
/** @var $action string */
echo form_open($module . '/' . $controller . '/' . $action);
echo form_fieldset('Information');
echo '<p>';
echo form_label('Order description');
echo form_input('description');
echo form_error('description');
echo '</p>';
echo '<p>';
echo form_label('Creation date');
echo form_input('creation_date');
echo form_error('creation_date');
echo '</p>';
echo '<p>';
echo form_label('Creator');
echo form_input('creator');
echo form_error('creator');
echo '</p>';

echo form_fieldset('Details');
echo form_fieldset_close();
echo form_submit('submit', 'Confirm');
