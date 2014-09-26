<?php

/**
 * Class Template_controller
 */
class Template_controller extends MX_Controller
{
    /**
     * Sample template
     * @param $module_name
     * @param $file_uri
     * @param null $data
     */
    function demo_template($module_name, $file_uri, $data = NULL)
    {
        //Prepare data for displaying
        $data['module_name'] = $module_name;
        $data['file_uri'] = $file_uri;

        //Display to view
        $this->load->view('/demo_template/' . 'index', $data);
    }

    /**
     * @param $data
     */
    function admin($data)
    {
        $this->load->view('admin', $data);
    }
}
