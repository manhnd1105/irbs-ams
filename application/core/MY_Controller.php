<?php
require_once APPPATH . "third_party/MX/Controller.php";

/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package        CodeIgniter
 * @subpackage    Libraries
 * @category    Libraries
 * @author        ExpressionEngine Dev Team
 * @link        http://codeigniter.com/user_guide/general/controllers.html
 */
class MY_Controller extends MX_Controller
{
    var $CI;

    /**
     * @var super_classes\RbacRestrictAccessFactory
     */
    var $restrict_factory;

    /**
     *
     */
    function __construct()
    {
        parent::__construct();
        $this->restrict_factory = \super_classes\RbacRestrictAccessFactory::get_instance();
        $this->CI = & get_instance();
        $this->restrict_access();
    }

    private function restrict_access()
    {
//        $router = & get_instance()->router;
//        $module = $router->fetch_module();
//        $controller = $router->fetch_class();
//        $method = $router->fetch_method();
        $module = $this->CI->router->fetch_module();
        $controller = $this->CI->router->fetch_class();
        $method = $this->CI->router->fetch_method();
        $acc_id = $this->session->userdata('acc_id');

        //If has no id => set id to 0 (unauthorized role id)
        if (!$acc_id)
        {
            $acc_id = 0;
        }

        $perm_path = '/irbs' . '/' . $module . '/' . $controller . '/' . $method;

        try
        {
            $status = $this->restrict_factory->check_access($acc_id, $perm_path);
            if (!$status)
            {
                echo 'access denied';
                if ($this->config->item('restrict_unauthorized'))
                {
                    die;
                }
            }
        } catch (RbacException $e)
        {
            echo 'access denied (permission not found), ' . $e->getMessage();
            if ($this->config->item('restrict_unauthorized'))
            {
                die;
            }
        }
    }
}