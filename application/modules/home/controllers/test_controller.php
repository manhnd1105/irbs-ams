<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 9/9/14
 * Time: 4:33 PM
 */

class Test_controller extends Frontend_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        try
        {
            throw new Exception('test exception');
        } catch (Exception $e)
        {
            \super_classes\IrbsException::write_log('error', $e);
        }
    }
} 