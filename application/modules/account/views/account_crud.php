<script type="text/javascript">
    base_url = '<?=base_url()?>';
</script>

<?php
/**
 * @var $info array of string Basic information of accounts
 */
echo "<link rel='stylesheet' href='" . base_url() . "assets/third_party/jstree/themes/default/style.min.css'/>";
echo "<script src='" . base_url() . "assets/js/jquery.js'></script>";
echo "<script src='" . base_url() . "assets/third_party/jstree/jstree.min.js'></script>";
echo "<script src='" . base_url() . "application/modules/account/views/js/role_tree.js'></script>";
?>

<?php
echo anchor('account/account_controller/view_create', 'Create new account');
?>
<div class="Table">
    <div class="Heading">
        <div class="Cell">
            <p>ID</p>
        </div>
        <div class="Cell">
            <p>Account Name</p>
        </div>
        <div class="Cell">
            <p>Staff Name</p>
        </div>
        <div class="Cell">
            <p>Password</p>
        </div>
        <div class="Cell">
            <p>Address</p>
        </div>
    </div>

    <?php
    foreach ($info as $row) {
        /* Begin of a row */
        echo "<div class='Row'>";
        $id = $row['id'];
        foreach ($row as $cell) {
            if (!is_array($cell)) {
                /* Begin of a cell */
                echo "<div class='Cell'>";
                echo $cell;
                echo "</div>";
                /* End of a cell */
            }
        }
        //Add additional crud cells
        echo "<div class='Cell'>";
        echo anchor('account/account_controller/view_update/' . $id, 'Edit');
        echo "</div>";
        echo "<div class='Cell'>";
        echo anchor('account/account_controller/delete/' . $id, 'Remove');
        echo "</div>";
        echo "<div class='Cell'>";
        echo anchor('account/account_controller/list_roles/' . $id, 'Assigned roles');
        echo "</div>";
        echo "<div class='Cell'>";
//        echo form_button('view_update_ajax', 'Update using ajax', "class='view_update_ajax' acc_id='" . $id . "'");
//        echo anchor('#', 'Update using ajax', "class='view_update_ajax' id='" . $id . "'");
        echo "</div>";
        /* End of a row */
        echo '</div>';

    }

    ?>
</div>