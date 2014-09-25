<?php
namespace super_classes;

/**
 * Class StatusFactory
 * @package super_classes
 */
class StatusFactory
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
        //get_instance()->load->model('order/Model_order');
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
     * @return RoleFactory
     */
    public static function get_instance()
    {
        try {
            if (!self::$instance) {
                self::$instance = new StatusFactory();
            }
            return self::$instance;

        } catch (Exception $e) {
            echo 'error: ' . $e->getMessage();
        }
    }

    /**
     * @param $info
     * @return Status
     */
    public static function create_component_status($info)
    {
        $component = new Status();
        $component->set_component_name('component_status');
        $component->set_name($info['name']);
        $component->set_description($info['description']);
        return $component;
    }
}