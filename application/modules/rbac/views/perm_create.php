<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 8/7/14
 * Time: 2:15 PM
 */
/**
 * @var int $parent_id the id of selected node in tree that act as parent node of this desired node
 * @var string $parent_title option, the title of selected node
 * @var $form_action string
 */

echo form_open($form_action);
echo form_hidden('parent_title', $parent_title);
echo form_hidden('parent_id', $parent_id);

echo '<p>';
echo form_label('Title');
echo form_input('title');
echo form_error('title');
echo '</p>';
echo '<p>';
echo form_label('Description');
echo form_input('desc');
echo form_error('desc');
echo '</p>';

echo form_submit('submit', 'Confirm');

