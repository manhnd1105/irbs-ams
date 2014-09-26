<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 8/8/14
 * Time: 9:37 AM
 */

namespace super_classes;
use SebastianBergmann\Exporter\Exception;


/**
 * Class RbacPermFactory
 * @package super_classes
 */
class RbacPermFactory implements ISingleton
{
    /**
     * @var RbacPermFactory
     */
    private static $instance;

    /**
     * @var \Model_rbac_perm
     */
    private $model_rbac_perm;
    /**
     * Private constructor so nobody else can instance it
     *
     */
    private function __construct()
    {
        get_instance()->load->model('rbac/Model_rbac_perm');
        $this->model_rbac_perm = get_instance()->Model_rbac_perm;
    }


    /**
     * Private clone method to prevent cloning of the instance of the
     * *Singleton* instance.
     *
     * @return void
     */
    private function __clone(){}

    /**
     * Call this method to get singleton
     * @return RbacPermFactory
     */
    public static function get_instance()
    {
        try
        {
            if (!self::$instance) {
                self::$instance = new RbacPermFactory();
            }
            return self::$instance;

        } catch (\Exception $e) {
            IrbsException::write_log('error', $e);
        }
    }

    /**
     * @return mixed
     */
    public function reset_all()
    {
        return $this->model_rbac_perm->reset_all();
    }

    /**
     * Create a new Perm object (without parent)
     * @param $info
     * @return RbacPerm
     * @throws \Exception
     */
    public function create_perm_obj($info)
    {
        $perm = null;
        try
        {
            //Create a new object and fill it with information
            $perm = new RbacPerm();
            $perm->set_id($info);
            $perm->set_title($info);
            $perm->set_desc($info);
        } catch (\Exception $e) {
            IrbsException::write_log('error', $e);
        }
        return $perm;
    }

    /**
     * Create a new Perm object and then save changes to database
     * @param $info
     * @return bool
     */
    public function create_perm($info)
    {
        try
        {
            //Create object from passed information
            $perm = $this->create_perm_obj($info);
            $perm->set_parent_id($info);

            //Save changes into database
            $status = $this->map_db($perm);
        } catch (\Exception $e) {
            IrbsException::write_log('error', $e);
            return false;
        }
        return $status;
    }

    /**
     * Get information of a perm according to its id
     * @param int $id
     * @return array of string
     */
    public function read_perm($id)
    {
        return $this->model_rbac_perm->get($id);
    }

    /**
     * Get information of all perms
     * @return mixed array
     */
    public function read_perms()
    {
        return $this->model_rbac_perm->gets();
    }

    /**
     * Get information of all perms and then transform into html format
     * @return mixed array
     */
    public function read_perms_html()
    {
        //Get permissions list from database
        $perms = $this->read_perms();

        //Ask factory to transform them into html (tree format)
        $tree = TreeBuilder::my_render_tree_html($perms);
        return $tree;
    }

    /**
     * Update information of a perm
     * @param $info array of string
     * @return bool
     */
    public function update_perm($info)
    {
        try
        {
            //Update object by passed information
            $perm = $this->update_perm_obj($info);

            //Save changes to database
            $status = $this->map_db($perm);
        } catch (\Exception $e)
        {
            IrbsException::write_log('error', $e);
            return false;
        }
        return $status;
    }

    /**
     * Update information of a perm object
     * @param $info array of string
     * @return RbacPerm
     */
    public function update_perm_obj($info)
    {
        return $this->create_perm_obj($info);
    }

    /**
     * Delete a perm in database
     * @param int $id
     * @return bool
     */
    public function delete_perm($id)
    {
        try
        {
            $status = $this->model_rbac_perm_remove($id);
        } catch (\Exception $e) {
            IrbsException::write_log('error', $e);
            return false;
        }
        return $status;
    }
    /**
     * @param $id
     * @return bool
     */
    function model_rbac_perm_remove($id){
        $this->model_rbac_perm->remove($id);
        return true;
    }

    /**
     * Delete a perm in database according to its path in hierarchical perm tree
     * @param string $path
     * @return true
     */
    public function delete_perm_by_path($path)
    {
        try
        {
            $status = $this->model_rbac_perm_remove_path($path);
        } catch (\Exception $e)
        {
            IrbsException::write_log('error', $e);
            return false;
        }
        return $status;
    }
    /**
     * @param $path
     * @return bool
     */
    function model_rbac_perm_remove_path($path){
        $this->model_rbac_perm->remove_path(array('path' => $path));
        return true;
    }

    /**
     * Save changes on objects to database
     * @param RbacPerm $perm_obj
     * @return bool
     */
    public function map_db(RbacPerm $perm_obj)
    {
        //Get properties of this object
        $info = $perm_obj->get_props();
        $rbac_perm_id = $info['id'];
        try
        {
            //If object has no id => Insert new record to database
            if ($rbac_perm_id == NULL || $rbac_perm_id == "") {
                $this->map_db_has_no_id($info);
            }

            //If object has id => Update record to database
            else {
                $this->map_db_has_id($info);
            }
        } catch (\Exception $e) {
            IrbsException::write_log('error', $e);
            return false;
        }
        return true;
    }
    /**
     * @param $info
     * @return bool
     */
    private function map_db_has_no_id($info)
    {
        $rbac_perm_id = $this->model_rbac_perm_insert($info);
        return true;
    }
    /**
     * @param $info
     * @return int
     */
    function model_rbac_perm_insert($info){
        return $this->model_rbac_perm->insert($info);
    }

    /**
     * @param $info
     * @return bool
     */
    private function map_db_has_id($info)
    {
        $rbac_perm_id = $info['id'];
        if($rbac_perm_id == null ||$rbac_perm_id == '') {
            return false;
        } else {
            $status = $this->model_rbac_perm_modify($info);
            return true;
        }

    }
    /**
     * @param $info
     */
    function model_rbac_perm_modify($info)
    {
        return $this->model_rbac_perm->modify($info);
    }


    /**
     * @return mixed
     */
    public function make_sample()
    {
        $sample = array(
            'account',
            'account/account_controller',
            'account/account_controller/index',
            'account/account_controller/create',
            'account/account_controller/update',
            'account/account_controller/delete',
            'account/account_controller/view_create',
            'account/account_controller/view_update',
            'account/account_controller/list_roles',
            'home',
            'home/home_controller',
            'home/home_controller/index',
            'template',
            'template/template_controller',
            'template/template_controller/demo_template',
            'authentication',
            'authentication/authentication_controller',
            'authentication/authentication_controller/index',
            'authentication/authentication_controller/login',
            'authentication/authentication_controller/logout',
            'authentication/authentication_controller/view_main',
            'authentication/authentication_controller/view_login',
            'rbac',
            'rbac/rbac_controller',
            'rbac/rbac_controller/index',
            'rbac/rbac_controller/assign_role_perm',
            'rbac/rbac_controller/unassign_role_perm',
            'rbac/rbac_controller/view_assign_role_perm',
            'rbac/rbac_controller/assign_acc_role',
            'rbac/rbac_controller/unassign_acc_role',
            'rbac/rbac_controller/view_assign_acc_role',
            'rbac/role_controller',
            'rbac/role_controller/index',
            'rbac/role_controller/create',
            'rbac/role_controller/update',
            'rbac/role_controller/delete',
            'rbac/role_controller/view_create',
            'rbac/role_controller/view_update',
            'rbac/perm_controller',
            'rbac/perm_controller/index',
            'rbac/perm_controller/create',
            'rbac/perm_controller/update',
            'rbac/perm_controller/delete',
            'rbac/perm_controller/view_create',
            'rbac/perm_controller/view_update',
            'rbac/perm_controller/assign_perm_role',
            'rbac/perm_controller/assign_perm_roles',
        );
        $status = $this->model_rbac_perm->make_sample($sample);
        return $status;

    }
} 