<script type="text/javascript">
    base_url = '<?=base_url()?>';
</script>

<link rel="stylesheet" href="<?php echo base_url() . "assets/css/bootstrap.css"; ?>">
<script type="text/javascript" src="<?php echo base_url() . "assets/js/jquery.js"; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . "assets/js/bootstrap.js"; ?>"></script>

<?php
/** @var $module_name string */
/** @var $controller_name string */
/** @var $action string */



echo '<div class="row">';
echo '<div  class="col-sm-4">';
echo '</div >';

echo '<div  class="col-sm-4">';

echo form_open($module_name . '/' . $controller_name . '/' . $action);
echo form_fieldset('Login ');
echo '<div class="form-group">';
echo form_label('Username/Email');
echo form_input('acc_name', 'manhnd',"class='form-control'","id=''");
echo form_error('acc_name');

echo '</div>';

echo '<div class="form-group">';
echo form_label('Password');
echo form_password('password', '123456',"class='form-control'","id=''");
echo form_error('password');
echo '</div>';

echo form_submit('submit', 'Login', "class='btn btn-success'");echo '  ';
echo anchor('','Forgot password ?');
echo  '<br/>';
echo "<img src='".base_url()."asserts/img/facebook_icon.png' alt='...' class='img-circle'>";
echo anchor('http://facebook.com','Login by Facebook account');
echo  '<br/>';
echo '<img src="...img/google_icon.jpg" alt="..." class="img-circle">';
echo anchor('http://google.com','Login by Google account');
echo '</div >';
echo '<div  class="col-sm-4">';
echo '</div >';
echo '</div>';

echo form_fieldset_close();

if (isset($last_url))
{
    echo "<input type='hidden' name='last_url' value='" . urldecode(urldecode(urldecode($last_url))) . "'/>";
}



