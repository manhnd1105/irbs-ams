<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Home_controller
 * @property Template_controller template_controller
 */
class Home_controller extends Backend_Controller
{
    /**
     *
     */
    function __construct()
    {
        parent::__construct();
        $this->load->module('template/template_controller');
    }

    /**
     * Steps of making site layout:
     * 1. In method of current controller: load Template Controller and pass it the URI of desired view that you want to display
     * 2. In Template Controller of Template Module: Add new method (template name)
     * 3. In view of Template Module: load view of desired controller
     */
    public function index()
    {

        if($this->session->userdata('is_logged_in')){
            $this->template_controller->demo_template('home', 'index');
        }else{
         redirect('authentication/authentication_controller/view_login');
        }

        //Call the layout (as method of template controller) that you want to display
        //$data['actions'] = $this->init_actions();
        //$this->template_controller->demo_template('home', 'index');
    }

    /**
     * @return array
     */
    function init_actions()
    {
        $actions = array(
            anchor('account/account_controller', 'Manage Inkiu accounts'),
            anchor('account/account_controller/view_create', 'Create Inkiu account'),
            anchor('authentication/authentication_controller/', 'Authentication'),
            anchor('rbac/perm_controller/', 'Manage permissions'),
            anchor('rbac/role_controller/', 'Manage roles'),
            anchor('http://inkiu.vn/irbs-dms/index.php/api/api_controller/order', 'Access to external system: get list orders')
        );
        return $actions;
    }

}
