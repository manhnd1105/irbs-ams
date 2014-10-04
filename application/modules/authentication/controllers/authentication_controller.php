<?php

/**
 * Created by PhpStorm.
 * User: dell
 * Date: 7/24/14
 * Time: 9:11 AM
 * @property Template_controller template_controller
 */
class Authentication_controller extends Frontend_Controller
{
    /**
     * @var super_classes\InkiuAccountFactory
     */
    private $account_factory;

    /**
     *
     */
    function __construct()
    {
        parent::__construct();
        $this->account_factory = \super_classes\InkiuAccountFactory::get_instance();
        $this->load->module('template/template_controller');
    }

    /**
     *
     */
    function index()
    {
        if ($this->session->userdata('is_logged_in')) {
            $this->return_to_main();
        } else {
            $this->view_login(false);
        }
    }

    /**
     * Render a page based on chosen template
     * @param $controller
     * @param $method
     * @param $data
     */
    private function render($controller, $method, $data)
    {
        $this->template_controller->demo_template($controller, $method, $data);
    }

    /**
     * Redirect users to main view
     * @param string $main_view_uri
     */
    private function return_to_main($main_view_uri = 'authentication/authentication_controller/view_main')
    {
        $main_view_uri = 'account/account_controller';
        redirect($main_view_uri);
    }

    /**
     * @param bool $show_error
     */
    public function view_login($show_error = false)
    {
        $data['module_name'] = 'authentication';
        $data['controller_name'] = 'authentication_controller';
        $data['action'] = 'login';
        $data['error'] = $show_error;
        $this->render('authentication', '/login', $data);
    }

    /**
     *
     */
    public function view_main()
    {
        $data['acc_name'] = $this->session->userdata('acc_name');
        $this->render('home', 'index', $data);
    }

    /**
     *
     */
    public function login()
    {
        $info = $this->input->post();
//        $acc_name = $post['acc_name'];
//        $password = $post['password'];
        $status = $this->account_factory->authenticate($info, $this->session);
        if ($status)
        {
            $this->return_to_main();
        } else
        {
            $this->view_login(true);
        }
//        if ($status) {
//            // If the user is valid => store to session and redirect to the main view
//            $session_data = array(
//                'acc_id' => $this->account_factory->get_acc_id_by_name($acc_name),
//                'acc_name' => $acc_name
//            );
//            $this->account_factory->store_data_to_session($session_data, $this->session);
//            $this->return_to_main();
//        } else {
//            // Otherwise show the login screen with an error message.
//            $this->view_login(true);
//        }
    }

    /**
     *
     */
    public function logout()
    {
        $this->session->sess_destroy();
        $this->return_to_main();
    }
} 