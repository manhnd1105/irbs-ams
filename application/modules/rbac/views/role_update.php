<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 8/7/14
 * Time: 2:15 PM
 */
/**
 * @var int $id the id of selected entity
 * @var string $desc the description of selected node
 * @var string $title the title of selected node
 * @var $form_action string
 */

echo form_open($form_action);
echo form_hidden('id', $id);

echo '<p>';
echo form_label('Title');
echo form_input('title', $title);
echo form_error('title');
echo '</p>';
echo '<p>';
echo form_label('Description');
echo form_input('desc', $desc);
echo form_error('desc');
echo '</p>';

echo form_submit('submit', 'Confirm');