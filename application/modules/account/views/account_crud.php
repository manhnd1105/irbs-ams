<script type="text/javascript">
    base_url = '<?=base_url()?>';
</script>


<?php
/**
 * @var $info array of string Basic information of accounts
 */

//echo "<link rel='stylesheet' href='" . base_url() . "dist/themes/default/style.min.css'/>";
//echo "<script src='" . base_url() . "dist/libs/jquery.js'></script>";
//echo "<script src='" . base_url() . "dist/jstree.min.js'></script>";
//echo "<script src='" . base_url() . "application/modules/account/views/js/role_tree.js'></script>";


echo '<div class="row">';

echo '<div  class="col-sm-12">';


echo '<div class="panel panel-default">';
echo '<div class="panel-heading">Account Management</div>';
echo '<div class="table-responsive">';
echo '<table class="table">';
    echo '<tr>';
        echo '<td> Id</td>';
        echo '<td> Account Name </td>';
        echo '<td> Staff Name </td>';
        echo '<td> Password </td>';
        echo '<td> Address </td>';
        echo '<td> Action </td>';

        echo '</tr>';


    foreach ($info as $row) {
        $id = $row['id'];

        echo '<tr >';
        echo '<td >'.$row['id'].'</td>';
        echo '<td >'.$row['account_name'].'</td>';
        echo '<td>'.$row['staff_name'].'</td>';
        echo '<td>'.$row['password'].'</td>';
        echo '<td>'.$row['address'].'</td>';
        echo '<td>'.'<span class="label label-info">'.anchor('account/account_controller/view_update/' . $id, 'Edit').'</span>','  ',
        '<span class="label label-info">'.anchor('account/account_controller/delete/' . $id, 'Remove').'</span>',' ',
        '<span class="label label-info">'.anchor('account/account_controller/list_roles/' . $id, 'Assigned roles').'</span>'.'</td>';

        echo '</tr>';
    }

    echo '</table>';
echo '</div>';
echo '</div>';

echo '</div>';
echo '</div>';


echo '<div>';
echo '<ul class="pagination">';
echo ' <li class="disabled"><span>&laquo;</span></li>';
echo '<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>';
echo ' <li class="disabled"><a href="#">2</a> </span></li>';
echo ' <li class="disabled"><a href="#">3</a></li>';
echo ' <li class="disabled"><span>&raquo;</span></li>';
echo '</ul>';
echo '</div>';

