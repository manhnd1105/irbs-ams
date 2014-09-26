<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 9/5/14
 * Time: 10:22 AM
 */

namespace super_classes;
use PhpRbac\Rbac;

/**
 * Class RbacRestrictAccessFactory
 * @package super_classes
 */
class RbacRestrictAccessFactory
{
    private $rbac;
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
        $this->rbac = new Rbac();
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
     * @return RbacRestrictAccessFactory
     */
    public static function get_instance()
    {
        try
        {
            if (!self::$instance) {
                self::$instance = new RbacRestrictAccessFactory();
            }
            return self::$instance;

        } catch (Exception $e) {
            throw $e->getMessage();
        }
    }

    /**
     * Check whether an account has permission to do an action provided by path
     * @param $acc_id int
     * @param $perm_path string
     * @return bool
     */
    public function check_access($acc_id, $perm_path)
    {
        try
        {
            //Ask factory to find path id according to permission path
            $perm_id = $this->find_path_id($perm_path);

            //Ask factory to check whether this account has enough permission
            $status = $this->rbac->check($perm_id, $acc_id);
        } catch (\Exception $e)
        {
//            log_message($e->getMessage());
            return false;
        }
        return $status;
    }

    private function find_path_id($perm_path)
    {
        return $this->rbac->Permissions->pathId($perm_path);
    }
} 