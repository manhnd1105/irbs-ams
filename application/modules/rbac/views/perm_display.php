<script type="text/javascript">
    base_url = '<?=base_url()?>';
</script>

<?php
/**
 * @var string $perm_tree
 */

echo "<link rel='stylesheet' href='" . base_url() . "assets/third_party/jstree/themes/default/style.min.css'/>";
echo "<script src='" . base_url() . "assets/js/jquery.js'></script>";
echo "<script src='" . base_url() . "assets/third_party/jstree/jstree.min.js'></script>";
echo "<script src='" . base_url() . "application/modules/rbac/views/js/jstree_perm.js'></script>";

echo '<div id="jstree">';
print $perm_tree;
echo '</div>';

echo form_button('btn_create', 'Add node', "id='btn_create'");
echo form_button('btn_update', 'Modify node', "id='btn_update'");
echo form_button('btn_delete', 'Remove node', "id='btn_delete'");
//echo "<div id='event_result'></div>";

