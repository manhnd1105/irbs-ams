<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 9/9/14
 * Time: 4:32 PM
 */

namespace super_classes;


class TestFactory {
    /**
     * Used to hold Singleton instance
     * @var
     */
    private static $instance;

    private $model;

    /**
     * Private constructor so nobody else can instance it
     *
     */

    private function __construct()
    {
        get_instance()->load->model('Model_test');
        $this->model = get_instance()->Model_test;
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
     * @return RbacAssigningFactory
     */
    public static function get_instance()
    {
        try {
            if (!self::$instance) {
                self::$instance = new TestFactory();
            }
            return self::$instance;

        } catch (Exception $e) {
            throw $e->getMessage();
        }
    }
    public function test()
    {
        return $this->model->test();
    }
} 