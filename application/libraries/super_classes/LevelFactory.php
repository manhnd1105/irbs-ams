<?php
namespace super_classes;

/**
 * Class LevelFactory
 * @package super_classes
 */
class LevelFactory
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
                self::$instance = new LevelFactory();
            }
            return self::$instance;

        } catch (Exception $e) {
            echo 'error: ' . $e->getMessage();
        }
    }

    /**
     * @param $info
     * @return Level
     */
    public static function create_component_level($info)
    {
        $component = new Level();
        $component->set_component_name('component_level');
        $component->set_level($info);
        return $component;
    }
}