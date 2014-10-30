<?php
/**
 * Created by PhpStorm.
 * User: manh
 * Date: 10/30/14
 * Time: 9:17 AM
 */
echo '<ul>';
if (isset($actions)) {
    foreach ($actions as $link => $title) {
        echo '<li class="active">' . anchor($link, $title) . '</li>';
    }
}
echo '</ul>';