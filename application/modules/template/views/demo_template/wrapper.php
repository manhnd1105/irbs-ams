<div id="page-wrapper">
    <?php
    /**
     * Created by PhpStorm.
     * User: Tuan Long
     * Date: 10/6/2014
     * Time: 5:04 PM
     */

    echo '<div id="event_result"></div>';

    /** @var string $module_name name of module need to load */
    /** @var string $file_uri URI that need to load */
    $this->load->view($module_name . '/' . $file_uri); //TODO extend to multi module views like Joomla
    ?>
</div>
