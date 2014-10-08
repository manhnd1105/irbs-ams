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
        //If user has logged in => redirect to main view
        if ($this->session->userdata('is_logged_in'))
        {
            $this->return_to_main();
        }
        //If has not logged => force user to login
        else
        {
            $this->view_login(false);
        }
    }

//    /**
//     * Render a page based on chosen template
//     * @param $controller
//     * @param $method
//     * @param $data
//     */
//    private function render($controller, $method, $data)
//    {
//        $this->template_controller->demo_template($controller, $method, $data);
//    }

    /**
     * Redirect users to main view
     * @param string $main_view_uri
     */
    private function return_to_main($main_view_uri = 'account/account_controller')
    {
        redirect($main_view_uri);
    }

    public function view_login($last_url = null)
    {
        $data['module_name'] = 'authentication';
        $data['controller_name'] = 'authentication_controller';
        $data['action'] = 'login';
        $data['last_url'] = $last_url;

        $this->load->view('login', $data);
    }

//    /**
//     *
//     */
//    public function view_main()
//    {
//        $data['acc_name'] = $this->session->userdata('acc_name');
//        $this->render('home', 'index', $data);
//    }

    /**
     *
     */
    public function login()
    {
        //Get information from POST
        $info = $this->input->post();

        //Ask factory to validate credentials and then save to session
        $status = $this->account_factory->authenticate($info, $this->session);

        //If account credentials are correct => redirect to last url or main view
        if ($status)
        {
            //If last url exists => redirect to its entry point
            if ($info['last_url'] !== "")
            {
                redirect($info['last_url'] . '/home/home_controller/index/' . $info['acc_name']);
            }
            //If has no last url => redirect to main view
            else
            {
                $this->return_to_main();
            }
        }
        //If credentials are incorrect => force user to login again
        else
        {
            $this->view_login(true);
        }
    }

    /**
     *
     */
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('authentication/authentication_controller/view_login');
    }
} 