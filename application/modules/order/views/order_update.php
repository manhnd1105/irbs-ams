<?php
/** @var $module string */
/** @var $controller string */
/** @var $action string */
/** @var $order_info array */
echo form_open($module . '/' . $controller . '/' . $action);
echo form_fieldset('Information');
echo form_hidden('id', $order_info['id']);
echo '<p>';
echo form_label('Order description');
echo form_input('description', $order_info['description']);
echo form_error('description');
echo '</p>';
echo '<p>';
echo form_label('Creation date');
echo form_input('creation_date', $order_info['creation_date']);
echo form_error('creation_date');
echo '</p>';
echo '<p>';
echo form_label('Creator');
echo form_input('creator', $order_info['creator']);
echo form_error('creator');
echo '</p>';

echo form_fieldset('Details');
echo form_fieldset_close();
echo form_submit('submit', 'Confirm');
