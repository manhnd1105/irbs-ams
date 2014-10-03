<?php
/**
 * @var string $form_action
 * @var string $parent_id
 */

echo '<div class="row">';
    echo '<div  class="col-sm-4">';
    echo '</div >';

    echo '<div  class="col-sm-4">';
        echo form_open($form_action, "class='form-horizontal'");
        echo form_hidden('parent_id', $parent_id);
        echo form_fieldset('Detail information');

        echo '<div class="form-group-sm">';
        echo form_label('Login name');
        echo form_input('account_name','',"class='form-control'","id=''");
        echo form_error('account_name');
        echo '</div>';

        echo '<div class="form-group-sm">';
        echo form_label('Full name');
        echo form_input('staff_name','',"class='form-control'","id=''");
        echo form_error('staff_name');
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

        echo form_fieldset_close();

        echo form_submit('btn_create', 'Sign up',"class='btn btn-success'");
        echo  '<br/>';
        echo '<img src="#" alt="#" class="img-circle">';
        echo anchor('','Use existing Google account');
        echo  '<br/>';
        echo '<img src="#" alt="#" class="img-circle">';
        echo anchor('','Use existing Facebook account');

    echo '</div >';

    echo '<div  class="col-sm-4">';
    echo '</div >';
echo '</div>';

