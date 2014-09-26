<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 8/8/14
 * Time: 9:37 AM
 */

namespace super_classes;

/**
 * Class RbacRoleFactory
 * @package super_classes
 */
/**
 * Class RbacRoleFactory
 * @package super_classes
 */
class RbacRoleFactory implements ISingleton
{
    /**
     * @var RbacRoleFactory
     */
    private static $instance;

    /**
     * @var \Model_rbac_role
     */
    private $model_rbac_role;

    /**
     * Private constructor so nobody else can instance it
     *
     */
    private function __construct()
    {
        get_instance()->load->model('rbac/Model_rbac_role');
        $this->model_rbac_role = get_instance()->Model_rbac_role;
    }

    /**
     * Private clone method to prevent cloning of the instance of the
     * *Singleton* instance.
     *
     * @return void
     */
    private function __clone() {}

    /**
     * Call this method to get singleton
     * @return RbacRoleFactory
     * @throws string
     */
    public static function get_instance()
    {
        try
        {
            if (!self::$instance)
            {
                self::$instance = new RbacRoleFactory();
            }
            return self::$instance;

        } catch (\Exception $e)
        {
            IrbsException::write_log('error', $e);
        }
    }


    /**
     * Reset all roles in database (only root exists)
     */
    public function reset_all()
    {
        try
        {
            $status = $this->model_rbac_role_reset_all();
        } catch (\Exception $e)
        {
            IrbsException::write_log('error', $e);
            return false;
        }
        return $status;
    }

    /**
     * @return bool
     */
    function model_rbac_role_reset_all(){
        return $this->model_rbac_role->reset_all();
    }


    /**
     * Create a new Role object (without parent)
     * @param $info
     * @return RbacRole
     * @throws string
     */
    public function create_role_obj($info)
    {
        //Create a new object and fill it with information
        $role = new RbacRole();
        $role->set_id($info);
        $role->set_title($info);
        $role->set_desc($info);
        return $role;
    }

    /**
     * Create a new Role object and then save changes to database
     * @param $info
     * @return bool
     */
    public function create_role($info)
    {
        //Creat e a new object and fill it with information
        $role = $this->create_role_obj($info);
        $role->set_parent_id($info);

        //Save changes into database
        return $this->map_db($role);
    }

    /**
     * Get information of a role according to its id
     * @param int $id
     * @return array of string
     */
    public function read_role($id)
    {
        return $this->model_rbac_role->get($id);
    }

    /**
     * Get information of a role and then return an object
     * @param int $id
     * @return RbacRole
     */
    public function read_role_obj($id)
    {
        //Get all role information from database
        $info = $this->read_role($id);

        //Create object with above information
        $role_obj =$this->create_role_obj($info);
        $role_obj->set_parent_id($info);
        return $role_obj;
    }

    /**
     * Get information of all roles
     * @return mixed array
     */
    public function read_roles()
    {
        return $this->model_rbac_role->gets();
    }

    /**
     * Get information of all roles and then transform them into html tree
     * @return mixed array
     */
    public function read_roles_html()
    {
        //Get all roles from database
        $roles = $this->read_roles();
        //Transform them into html (tree format)
        return TreeBuilder::my_render_tree_html($roles);
    }

    /**
     * Update information of a Role
     * @param $info array of string
     * @return bool
     */
    public function update_role($info)
    {
        try
        {
            //Update object by passed information
            $role = $this->update_role_obj($info);

            //Save changes to database
            $status = $this->map_db($role);
        } catch (\Exception $e)
        {
            IrbsException::write_log('error', $e);
            return false;
        }
        return $status;

    }


    /**
     * Update information of a Role object
     * @param $info array of string
     * @return RbacRole
     */
    public function update_role_obj($info)
    {
        $this->create_role_obj($info);
    }

    /**
     * Delete a role in database
     * @param int $id
     * @return bool
     */
    public function delete_role($id){
        try
        {
            $status = $this->model_rbac_role_delete($id);
        } catch (\Exception $e)
        {
            IrbsException::write_log('error', $e);
            return false;
        }
        return $status;
    }


    /**
     * @param $id
     * @return bool
     */
    function model_rbac_role_delete($id)
    {
        $this->model_rbac_role->remove($id);
        return true;
    }


    /**
     * Save changes on objects to database
     * @param RbacRole $role_obj
     * @return bool
     */
    public function map_db(RbacRole $role_obj)
    {
        try
        {
            //Get properties of this object
            $id = $role_obj->get_id();
            $info = $role_obj->get_props();

            //If object has no id => Insert new record to database
            if ($id == NULL || $id == "") {
                $id =$this->model_rbac_insert($info);
            }
            //If object has id => Update record to database
            else {
               $this->model_rbac_modify($info);
            }
        } catch (\Exception $e)
        {
            IrbsException::write_log('error', $e);
            return false;
        }
        return true;
    }

    /**
     * @param $info
     * @return mixed
     */
    function model_rbac_insert($info){
        return  $this->model_rbac_role->insert($info);
    }

    /**
     * @param $info
     * @return bool
     */
    function model_rbac_modify($info){
        return  $this->model_rbac_role->modify($info);
    }

    /**
     * @return bool
     */
    public function make_sample()
    {
        $sample = array(
            'admin',
            'admin/local-admin',
            'admin/remote-admin',
            'member',
            'guest',
            'unauthorized'
        );
        return $status=$this->model_rbac_role_make_sample($sample);

    }

    /**
     * @param $sample
     * @return bool
     */
    function model_rbac_role_make_sample($sample){
        return  $this->model_rbac_role->make_sample($sample);

    }

    /**
     * Allow unauthorized account to access authentication module
     */
    public function set_unauthorized_access($unauthorized_id = 0,
                                                   $unauthorized_role_id = 8,
                                                   $authentication_perms_id = array(12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24))
    {
        return $this->model_rbac_role->set_unauthorized_access($unauthorized_id,
            $unauthorized_role_id, $authentication_perms_id);
    }
}