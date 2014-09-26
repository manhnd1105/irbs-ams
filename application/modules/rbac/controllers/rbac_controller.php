<?php

/**
 * Created by PhpStorm.
 * User: dell
 * Date: 7/30/14
 * Time: 3:36 PM
 * @property mixed template_controller
 */
class Rbac_controller extends Frontend_Controller
{
    /**
     * @var super_classes\RbacRoleFactory
     */
    private $rbac_role_factory;

    /**
     * @var super_classes\RbacPermFactory
     */
    private $rbac_perm_factory;

    /**
     * @var super_classes\InkiuAccountFactory
     */
    private $acc_factory;

    /**
     * @var super_classes\RbacAssigningFactory
     */
    private $rbac_assigning_factory;

    /**
     *
     */
    function __construct()
    {
        parent::__construct();
        $this->load->module('template/template_controller');
        $this->rbac_role_factory = \super_classes\RbacRoleFactory::get_instance();
        $this->rbac_perm_factory = \super_classes\RbacPermFactory::get_instance();
        $this->acc_factory = \super_classes\InkiuAccountFactory::get_instance();
        $this->rbac_assigning_factory = \super_classes\RbacAssigningFactory::get_instance();
    }

    /**
     * Render a page for user to assign permission to a role
     */
    public function view_assign_role_perm()
    {
        //Prepare data for displaying by asking factory to collect information
        $data['role_tree'] = $this->rbac_role_factory->read_roles_html();
        $data['perm_tree'] = $this->rbac_perm_factory->read_perms_html();

        //Display to view
        $this->render('rbac', '/role_assign_perms', $data);
    }

    /**
     * Perform assign permission to a role
     */
    public function assign_role_perm()
    {
        //Get data from POST
        $role_id = $this->input->post('role_id');
        $perm_id = $this->input->post('perm_id');

        //Ask factory instance to perform assigning operation
        $status = $this->rbac_assigning_factory->assign_role_perm($role_id, $perm_id);

        //Response transaction status to client
        $response = array(
            'status' => ($status) ? 'Assigned' : 'Error',
            'role_id' => $role_id,
            'perm_id' => $perm_id
        );
        print_r($response);
    }

    /**
     * Perform unassign permissions of a role
     */
    public function unassign_role_perm()
    {
        //Get data from POST
        $role_id = $this->input->post('role_id');
        $perm_id = $this->input->post('perm_id');

        //Ask factory instance to perform assigning operation
        $status = $this->rbac_assigning_factory->unassign_role_perm($role_id, $perm_id);

        //Response transaction status to client
        $response = array(
            'status' => ($status) ? 'Unassigned' : 'Error',
            'role_id' => $role_id,
            'perm_id' => $perm_id
        );
        print_r($response);
    }

    /**
     * Render a page based on chosen template
     * @param $controller
     * @param $method
     * @param $data
     */
    private function render($controller, $method, $data)
    {
        //Use demo_template to keep page layout
        $this->template_controller->demo_template($controller, $method, $data);
    }

    /**
     * Render a page for user to assign roles to an account
     */
    public function view_assign_acc_role()
    {
        //Prepare data for displaying by asking factory to collect information
        $data['role_tree'] = $this->rbac_role_factory->read_roles_html();
        $data['acc_list'] = $this->acc_factory->load_accounts_info_links();

        //Display to view
        $this->render('rbac', '/acc_assign_roles', $data);
    }

    /**
     * Perform assign a role to an account
     */
    public function assign_acc_role()
    {
        //Get data from POST
        $role_id = $this->input->post('role_id');
        $acc_id = $this->input->post('acc_id');

        //Ask factory instance to perform assigning operation
        $status = $this->rbac_assigning_factory->assign_acc_role($role_id, $acc_id);

        //Response transaction status to client
        $response = array(
            'status' => ($status) ? 'Assigned' : 'Error',
            'role_id' => $role_id,
            'acc_id' => $acc_id
        );
        print_r($response);
    }

    /**
     * Perform unassign role of an account
     */
    public function unassign_acc_role()
    {
        //Get data from POST
        $role_id = $this->input->post('role_id');
        $acc_id = $this->input->post('acc_id');

        //Ask factory instance to perform assigning operation
        $status = $this->rbac_assigning_factory->unassign_acc_role($role_id, $acc_id);

        //Response transaction status to client
        $response = array(
            'status' => ($status) ? 'Unassigned' : 'Error',
            'role_id' => $role_id,
            'acc_id' => $acc_id
        );
        print_r($response);
    }

    /**
     * Assign roles to a permission
     * @param $perm_id
     * @param $roles_id
     * @return bool
     */
    public function assign_perm_roles($perm_id, $roles_id)
    {
        //Ask factory to perform assigning operation
        $status = $this->rbac_assigning_factory->assign_perm_roles($perm_id, $roles_id);

        //Print result
        echo ($status) ? 'Assigned' : 'Error';
    }

    /**
     * Assign a role to a permission
     * @param $role_id
     * @param $perm_id
     * @return bool
     */
    public function assign_perm_role($perm_id, $role_id)
    {
        //Ask factory to perform assigning operation
        $status = $this->rbac_assigning_factory->assign_role_perm($role_id, $perm_id);

        //Display result
        echo ($status) ? 'Assigned' : 'Error';
    }

    /**
     * Enable unauthorized users to access login page
     */
    public function set_unauthorized_access()
    {
        //Ask factory to perform setting operation
        $status = $this->rbac_role_factory->set_unauthorized_access();

        //Display result
        echo ($status) ? 'Done' : 'Error';
    }
} 