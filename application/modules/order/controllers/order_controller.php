<?php

/**
 * Class Order_controller
 * @property super_classes\InkiuOrderFactory order_factory
 */
class Order_controller extends Frontend_Controller
{

    /**
     * @var super_classes\InkiuOrderFactory
     */
    private $order_factory;

    /**
     *
     */
    function __construct()
    {
        parent::__construct();
        $this->order_factory = \super_classes\InkiuOrderFactory::get_instance();
        $this->load->module('template/template_controller');
    }

    /**
     *
     */
    public function create()
    {
// 		BEGIN: Get all POST information
        $post = $this->input->post();
// 		END: Get all POST information

// 		BEGIN: Ask factory to create obj
        $order_obj = $this->order_factory->create_order($post);
// 		END: Ask factory to create obj

// 		BEGIN: Map changes to db
        $this->order_factory->map_db($order_obj);
// 		END: Map changes to db
        $this->view_crud();
    }

    /**
     *
     */
    public function update()
    {
// 		BEGIN: Get all POST information
        $post = $this->input->post();
// 		END: Get all POST information

// 		BEGIN: Ask factory to load obj
        $order_obj = $this->order_factory->load_orders($post['order_id']);
// 		END: Ask factory to load obj

// 		BEGIN: Map changes to db
        $this->order_factory->map_db($order_obj);
// 		END: Map changes to db
    }

    /**
     * @param $order_id
     */
    public function delete($order_id)
    {
        $this->order_factory->remove_orders($order_id);
        $this->view_crud();
    }

    /**
     *
     */
    public function view_create()
    {
// 		BEGIN: Load view
        $data['controller'] = 'order_controller';
        $data['action'] = 'create';
        $data['module'] = 'order';

        $this->template_controller->demo_template('order', '/order_create', $data);
// 		END: Load view
    }

    /**
     *
     */
    public function view_crud()
    {
// 		BEGIN: Get all orders information for displaying
        $orders_obj = $this->order_factory->load_orders();
        $orders_info = array();
        foreach ($orders_obj as $order_obj) {
            $orders_info[] = $order_obj->get_props();
        }
// 		END: Get all orders information for displaying

// 		BEGIN: Load view with above data
        $data['info'] = $orders_info;
        $this->load->module('template/template_controller');
        $this->template_controller->demo_template('order', '/order_crud', $data);
// 		END: Load view with above data
    }

    /**
     * @param $order_id
     */
    public function view_update($order_id)
    {
      //Get all saved information according to this account id
        $order = $this->order_factory->load_orders($order_id);
        $order_info = $order->get_props();

        //Load view with above data
        $data['order_info'] = $order_info;
        $data['controller'] = 'order_controller';
        $data['action'] = 'create';
        $data['module'] = 'order';
        $this->load->module('template/template_controller');
        $this->template_controller->demo_template('order', '/order_update', $data);
    }
}
