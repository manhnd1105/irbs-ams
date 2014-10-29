<?php

/**
 * Class Account_controller
 * @property Template_controller template_controller
 */
class Account_controller extends Frontend_Controller
{
    /**
     * Used to execute InkiuAccountFactory functions
     * @var super_classes\InkiuAccountFactory
     */
    private $account_factory;

    /**
     * Used to execute RbacRoleFactory functions
     * @var super_classes\RbacRoleFactory
     */
    private $rbac_role_factory;

    /**
     * @var \super_classes\RbacAssigningFactory
     */
    private $rbac_assigning_factory;

    /**
     * Construct function
     */
    function __construct()
    {
        parent::__construct();
        $this->account_factory = \super_classes\InkiuAccountFactory::get_instance();
        $this->rbac_role_factory = \super_classes\RbacRoleFactory::get_instance();
        $this->rbac_assigning_factory = \super_classes\RbacAssigningFactory::get_instance();
        $this->load->module('template/template_controller');
        $this->no_cache();

    }


    /**
     * Create an account
     */
    public function create()
    {
        //Get information from POST and then assign to factory performing
        $post = $this->input->post();
        $status = $this->account_factory->create_account($post);

        //Response transaction status to client
        $response = array(
            'status' => ($status) ? 'Created' : 'Error'
        );
        print_r($response);
    }

    /**
     * Redirect users to main view
     * @param string $main_view_uri
     */
    private function return_to_main($main_view_uri = 'account/account_controller')
    {
        redirect($main_view_uri);
    }


    /**
     * Update an account
     */
    public function update()
    {
        //Get information from POST and then assign to factory performing
        $post = $this->input->post();
        $status = $this->account_factory->update_account($post);

        //Response transaction status to client
        $response = array(
            'status' => ($status) ? 'Updated' : 'Error',
        );
        print_r($response);
    }

    /**
     * Delete an account
     */
    public function delete()
    {
        //Get information from POST and then assign to factory performing
        $post = $this->input->post();
        $id = $post['entity_id'];

        $status = $this->account_factory->remove_account($id);

        //Response transaction status to client
        $response = array(
            'status' => ($status) ? 'Deleted' : 'Error',
            'id' => $id
        );
        print_r($response);
    }

    /**
     * Render a page for creating account operation
     */
    public function view_create()
    {
        //Get information from POST
        $post = $this->input->post();

        //Render a page and pass needed data to it
        $data['parent_id'] = $post['entity_id'];
        $data['form_action'] = 'account/account_controller/create';
        $this->render('account', '/account_create', $data);
    }

    /**
     *
     */
    public function view_create_ajax()
    {
        //Get information from POST
        $post = $this->input->post();

        //Render a page and pass needed data to it
        $data['parent_id'] = $post['entity_id'];
        $data['form_action'] = 'account/account_controller/create';
        $this->load->view('account_create', $data);
    }

    /**
     * Render main crud view
     */
    public function index()
    {
//        //Get all accounts information from database
        $data['acc_tree'] = $this->account_factory->load_accounts_info_html();
        $this->render('account', '/index', $data);
    }

    /**
     * Render a page for updating account operation
     */
    public function view_update()
    {
        //Get information from POST
        $post = $this->input->post();

        //Get saved information from database
        $info = $this->account_factory->load_accounts_info($post['entity_id']);

        //Render a page and pass needed data to it
        $data['info'] = $info;
        $data['form_action'] = 'account/account_controller/update';
        $this->load->view('account_update', $data);
    }

//    /**
//     * Render a page for updating account operation (serving for ajax call)
//     * @param $id
//     */
//    public function view_update_ajax($id)
//    {
//        //Load saved roles id from database
//        $saved_ids = $this->rbac_role_factory->get_acc_assigned_roles_id($id);
//
//        //Send saved roles id to ajax callback
//        echo json_encode($saved_ids);
//    }

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
     * Render a page for reading account operation
     * @param $account_id
     */
    public function view_read($account_id)
    {
        /*        $acc = InkiuAccountFactory::load_account('1');
                foreach ($acc->_roles as $role_obj) {
                    $acc = $acc->wrap_role($role_obj->get_name());
                }
                $order_info = $acc->viewOrder('1');
                var_dump($order_info);*/
//        /** @var $data array */
//        $data['id'] = $account_id;
//        //TODO get data for displaying
//        $this->render('account', '/account_read', $data);
    }

    /**
     * Get list all roles that was assigned to this account
     */
    public function list_roles()
    {
        //Get input from POST
        $post = $this->input->post();

        $roles = $this->rbac_assigning_factory->get_acc_assigned_roles_html($post['acc_id']);

//        $data['role_list'] = $roles;
//        $data['back_to_main'] = 'account/account_controller';
//        $this->render('rbac', '/role_assigned', $data);
//        $this->template_controller->demo_template('rbac', '/role_assigned', $data);
        print($roles);
    }

    /**
     *
     */
    function test()
    {
        var_dump($this->account_factory->get_children_reviewers('8'));
    }

    /**
     *
     */
    private function no_cache()
    {
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }
}

