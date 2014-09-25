<?php
namespace super_classes;

/**
 * Class ImageFactory
 * @package super_classes
 */
class ImageFactory
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
                self::$instance = new ImageFactory();
            }
            return self::$instance;

        } catch (Exception $e) {
            echo 'error: ' . $e->getMessage();
        }
    }

    /**
     * @param $info
     * @return Image
     */
    public static function create_component_image($info)
    {
        $component = new Image();
        $component->set_component_name('component_image');
        $component->set_link($info);
        return $component;
    }
}