<?php

/**
 * Created by PhpStorm.
 * User: dell
 * Date: 8/7/14
 * Time: 1:57 PM
 * @property Template_controller template_controller
 */
class Role_controller extends Frontend_Controller
{
    /**
     * Used to manage business operations
     * @var super_classes\RbacRoleFactory
     */
    private $rbac_role_factory;

    /**
     * @var super_classes\RbacAssigningFactory
     */
    private $rbac_assigning_factory;

    /**
     * Construct function
     */
    function __construct()
    {
        parent::__construct();
        $this->load->module('template/template_controller');
        $this->rbac_role_factory = \super_classes\RbacRoleFactory::get_instance();
        $this->rbac_assigning_factory = \super_classes\RbacAssigningFactory::get_instance();
    }

    /**
     * Main crud function, show tree view to allow users performing CRUD operations
     */
    public function index()
    {
        //$this->rbac_role_factory->reset_all();
        $data['role_tree'] = $this->rbac_role_factory->read_roles_html();
        $this->template_controller->demo_template('rbac', '/role_display', $data);
    }

    /**
     * Redirect to main crud view
     */
    public function return_to_main()
    {
        //Default index page
        redirect('/rbac/role_controller');
    }

    /**
     * Render a page for users to create role
     */
    public function view_create()
    {
        //Get information from POST
        $post = $this->input->post();

        //Render a page and pass needed data to it
        $data['parent_title'] = $post['title'];
        $data['parent_id'] = $post['entity_id'];
        $data['form_action'] = 'rbac/role_controller/create';
        $this->load->view('role_create', $data);
    }

    /**
     * Render a page for users to update role
     */
    public function view_update()
    {
        //Get information from POST
        $post = $this->input->post();
        $id = $post['entity_id'];

        //Get saved information from database
        $info = $this->rbac_role_factory->read_role($id);

        //Render a page and pass needed data to it
        $data['id'] = $id;
        $data['title'] = $info['title'];
        $data['desc'] = $info['desc'];
        $data['form_action'] = 'rbac/role_controller/update';
        $this->load->view('role_update', $data);
    }

    /**
     * Perform create role operation
     */
    public function create()
    {
        //Get data from POST
        $post = $this->input->post();
        $info = array(
            'desc' => $post['desc'],
            'title' => $post['title'],
            'parent_id' => $post['parent_id']
        );

        //Ask factory to perform creating operation
        //Must include parent id of this entity
        $status = $this->rbac_role_factory->create_role($info);

        //Response transaction status to client
        $response = array(
            'status' => ($status) ? 'Created' : 'Error',
            'desc' => $post['desc'],
            'title' => $post['title'],
            'parent_id' => $post['parent_id']
        );
        print_r($response);
        $this->return_to_main();
    }

    /**
     * Move a role from a location to another one
     */
    public function move()
    {
        //TODO write content here
    }

    /**
     * Perform update role operation
     */
    public function update()
    {
        //Get data from POST and transform them into standard format
        $post = $this->input->post();
        $info = array(
            'id' => $post['id'],
            'desc' => $post['desc'],
            'title' => $post['title'],
        );

        //Ask factory to perform updating operation
        $status = $this->rbac_role_factory->update_role($info);

        //Response transaction status to client
        $response = array(
            'status' => ($status) ? 'Updated' : 'Error',
            'id' => $post['id'],
            'desc' => $post['desc'],
            'title' => $post['title'],
        );
        print_r($response);
        $this->return_to_main();
    }

    /**
     * Perform delete role operation
     */
    public function delete()
    {
        //Get data from POST
        $post = $this->input->post();
        $id = $post['entity_id'];

        //Ask factory instance to perform deleting operation
        $status = $this->rbac_role_factory->delete_role($id);

        //Response transaction status to client
        $response = array(
            'status' => ($status) ? 'Deleted' : 'Error',
            'id' => $id
        );
        print_r($response);
    }

    /**
     * Generate some sample roles for testing purpose
     */
    public function make_sample_roles()
    {
        //Ask factory to perform operation
        $status = $this->rbac_role_factory->make_sample();
//        echo ($status) ? 'Added' : 'Error';

        //Return to main view
        $this->return_to_main();
    }

    /**
     * Reset all roles to original state (only root exists)
     */
    public function reset()
    {
        //Ask factory to perform operation
        $status = $this->rbac_role_factory->reset_all();

        //Display to view and return to main view
        echo ($status) ? 'Done' : 'Error';
        $this->return_to_main();
    }

    /**
     * Get list of all assigned permissions of this role
     */
    public function list_assigned_perms()
    {
        //Collect information from POST
        $post = $this->input->post();
        $role_id = $post['role_id'];

        //Prepare data for displaying by ask factory to collect information
        $data['perm_list'] = $this->rbac_assigning_factory->get_role_assigned_perms_html($role_id);
        $data['back_to_main'] = 'rbac/role_controller/';

        //Display view
        $this->load->view('perm_assigned', $data);
    }
} 