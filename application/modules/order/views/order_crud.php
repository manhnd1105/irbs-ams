<div class="Table">
    <div class="Heading">
        <div class="Cell">
            <p>Description</p>
        </div>
        <div class="Cell">
            <p>Creation date</p>
        </div>
        <div class="Cell">
            <p>Creator</p>
        </div>
        <div class="Cell">
            <p>ID</p>
        </div>
    </div>

    <?php
    /** @var $info array */
    foreach ($info as $row) {
        /* Begin of a row */
        echo "<div class='Row'>";
        $order_id = $row['id'];
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
        echo anchor('order/order_controller/view_update/' . $order_id, 'Edit');
        echo "</div>";
        echo "<div class='Cell'>";
        echo anchor('order/order_controller/delete/' . $order_id, 'Remove');
        echo "</div>";
        echo "<div class='Cell'>";
        echo anchor('order/order_controller/view_create', 'Create');
        echo "</div>";
        /* End of a row */
        echo '</div>';

    }

    ?>
</div>