<?php $this->load->view('header'); ?>

<?php $this->load->view('banner'); ?>


<div class="container-fluid" >
<?php $this->load->view('side_menu'); ?>

        <div class="row" style="margin-top: 70px; margin-left: 20px;">
            <div class="col-sm-1">
            </div>
            <div class="col-sm-8">
                <div id="event_result"></div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <?php
                    /**
                     * @var string $module_name name of module need to load
                     * @var string $file_uri URI that need to load
                     */
                    $this->load->view($module_name . '/' . $file_uri); //TODO extend to multi module views like Joomla
                    ?>
            </div>
            <div class="col-sm-2">
            </div>
        </div>

</div>

    <?php $this->load->view('footer'); ?>