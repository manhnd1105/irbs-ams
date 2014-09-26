<?php

/**
 * Created by PhpStorm.
 * User: dell
 * Date: 7/30/14
 * Time: 3:36 PM
 * @property mixed template_controller
 */
class Perm_controller extends Frontend_Controller
{
    /**
     * Used to manage business operations
     * @var super_classes\RbacPermFactory
     */
    private $rbac_perm_factory;

    /**
     * Construct function
     */
    function __construct()
    {
        parent::__construct();
        $this->load->module('template/template_controller');
        $this->rbac_perm_factory = \super_classes\RbacPermFactory::get_instance();
    }

    /**
     * Main crud function, show tree view to allow users performing CRUD operations
     */
    public function index()
    {
        //Prepare data for displaying by asking factory to collect information
        $data['perm_tree'] = $this->rbac_perm_factory->read_perms_html();

        //Display to view
        $this->template_controller->demo_template('rbac', '/perm_display', $data);
    }

    /**
     * Redirect to main crud view
     */
    public function return_to_main()
    {
        //Default index page
        redirect('/rbac/perm_controller');
    }

    /**
     * Render a page for users to create perm
     */
    public function view_create()
    {
        //Get information from POST
        $post = $this->input->post();

        //Render a page and pass needed data to it
        $data['parent_title'] = $post['title'];
        $data['parent_id'] = $post['entity_id'];
        $data['form_action'] = 'rbac/perm_controller/create';
        $this->load->view('perm_create', $data);
    }

    /**
     * Render a page for users to update perm
     */
    public function view_update()
    {
        //Get information from POST
        $post = $this->input->post();
        $id = $post['entity_id'];

        //Get saved information from database
        $info = $this->rbac_perm_factory->read_perm($id);

        //Render a page and pass needed data to it
        $data['id'] = $id;
        $data['title'] = $info['title'];
        $data['desc'] = $info['desc'];
        $data['form_action'] = 'rbac/perm_controller/update';
        $this->load->view('perm_update', $data);
    }

    /**
     * Perform create perm operation
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
        $status = $this->rbac_perm_factory->create_perm($info);

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
     * Move a perm from a location to another one
     */
    public function move()
    {

    }

    /**
     * Perform update perm operation
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
        $status = $this->rbac_perm_factory->update_perm($info);

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
     * Perform delete perm operation
     */
    public function delete()
    {
        //Get data from POST
        $post = $this->input->post();
        $id = $post['entity_id'];

        //Ask factory instance to perform deleting operation
        $status = $this->rbac_perm_factory->delete_perm($id);

        //Response transaction status to client
        $response = array(
            'status' => ($status) ? 'Deleted' : 'Error',
            'id' => $id
        );
        print_r($response);
    }

    /**
     * Generate some sample permission nodes for testing process
     */
    public function make_sample_perms()
    {
        //Ask factory to perform operation
        $status = $this->rbac_perm_factory->make_sample();
//        echo ($status) ? 'Added' : 'Error';
        $this->return_to_main();
    }

    /**
     * Reset all permissions to original state (only root exists)
     */
    public function reset()
    {
        $status = $this->rbac_perm_factory->reset_all();
        echo ($status) ? 'Done' : 'Error';
        $this->return_to_main();
    }
} 