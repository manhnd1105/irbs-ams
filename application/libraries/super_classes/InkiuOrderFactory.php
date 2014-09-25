<?php
namespace super_classes;

/**
 * Class InkiuOrderFactory
 * @package super_classes
 */
final class InkiuOrderFactory implements ISingleton
{
    /**
     * @var
     */
    private static $instance;

    /**
     * Private constructor so nobody else can instance it
     *
     */
    private function __construct()
    {
        get_instance()->load->model('order/Model_order');
    }

    /**
     * Private clone method to prevent cloning of the instance of the
     * *Singleton* instance.
     *
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * Call this method to get singleton
     *
     * @return InkiuOrderFactory
     */
    public static function get_instance()
    {
        try {
            if (!self::$instance) {
                self::$instance = new InkiuOrderFactory();
            }
            return self::$instance;

        } catch (\Exception $e) {
            echo 'error: ' . $e->getMessage();
        }
    }

    /**
     * Create InkiuOrder object with passed information
     * @param $info
     * @return InkiuOrder
     */
    public static function create_order_obj($info)
    {
 		//Create new obj and fill its properties
        $order = new InkiuOrder();
        $order->set_description($info);
        $order->set_creation_date($info);
        $order->set_creator($info);
        $order->set_id($info);

 		//Setup its components
        /* 		$component_image = Order_component_image_factory::create_component_image($info);
                $component_feedback = Order_component_feedback_factory::create_component_feedback($info);
                $component_level = Order_component_level_factory::create_component_level($info);
                $component_status = Order_component_status_factory::create_component_status($info);

                $inkiu_order->add_component($component_image);
                $inkiu_order->add_component($component_feedback);
                $inkiu_order->add_component($component_level);
                $inkiu_order->add_component($component_status); */
        return $order;
    }

    public static function create_order($info)
    {
        //Create an object with above information
        $order = self::create_order_obj($info);

        //Save changes to database
        return self::map_db($order);
    }

    public static function update_order($info)
    {
        //Do the same steps as create_oder()
        return self::create_order($info);
    }

    public static function delete_order($id)
    {
        return \Model_order::delete_order($id);
    }

    public static function delete_orders($ids)
    {
        return \Model_order::delete_orders($ids);
    }


    /**
     * Map all changes of order instance to database
     * @param InkiuOrder $obj
     * @return bool
     * @throws \Exception
     */
    public static function map_db($obj)
    {
        //Collect information of that object
        $id = $obj->get_id();
        $info = $obj->get_props();

        //If has id => Update
        if ($id)
        {
            $status = self::map_db_has_id($info);
            if (!$status)
            {
                throw new \Exception('Error while updating in map_db');
            }
        }
        //If has no id => Create
        else
        {

            $status = self::map_db_has_no_id($info);
            if (!$status)
            {
                throw new \Exception('Error while creating in map_db');
            }
        }
        return true;
    }

    private static function map_db_has_id($info)
    {
        return \Model_order::edit_order($info);
    }

    private static function map_db_has_no_id($info)
    {
        return \Model_order::insert_order($info);
    }
}