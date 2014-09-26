<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 9/9/14
 * Time: 4:33 PM
 */

class Test_controller extends Frontend_Controller
{
    private $factory;
    function __construct()
    {
        parent::__construct();
        $this->factory = \super_classes\TestFactory::get_instance();
    }

    public function index()
    {
        echo $this->factory->test();
    }
} 