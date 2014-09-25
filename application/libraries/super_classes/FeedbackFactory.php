<?php
namespace super_classes;

/**
 * Class FeedbackFactory
 * @package super_classes
 */
final class FeedbackFactory implements ISingleton
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
        get_instance()->load->model('account/Model_role');
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
                self::$instance = new FeedbackFactory();
            }
            return self::$instance;

        } catch (Exception $e) {
            echo 'error: ' . $e->getMessage();
        }
    }

    /**
     * @param $info
     * @return Feedback
     */
    public static function create_component_feedback($info)
    {
        $component = new Feedback();
        $component->set_component_name('component_feedback');
        $component->set_name($info);
        $component->set_creation_date($info);
        return $component;
    }
}