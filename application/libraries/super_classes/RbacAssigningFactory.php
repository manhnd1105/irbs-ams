<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 9/5/14
 * Time: 4:12 PM
 */

namespace super_classes;


/**
 * Class RbacAssigningFactory
 * @package super_classes
 */
class RbacAssigningFactory implements ISingleton
{
    /**
     * Used to hold Singleton instance
     * @var RbacAssigningFactory
     */
    private static $instance;

    /**
     * @var \Model_rbac_assigning
     */
    private $model_rbac_assigning;

    /**
     * Private constructor so nobody else can instance it
     *
     */

    private function __construct()
    {
        get_instance()->load->model('rbac/Model_rbac_assigning');
        $this->model_rbac_assigning = get_instance()->Model_rbac_assigning;
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
     * @return RbacAssigningFactory
     */
    public static function get_instance()
    {
        try {
            if (!self::$instance) {
                self::$instance = new RbacAssigningFactory();
            }
            return self::$instance;

        } catch (\Exception $e) {
            IrbsException::write_log('error', $e);
        }
    }

    /**
     * Assign a permission to a role
     * @param $role_id
     * @param $perm_id
     * @return bool
     */
    public function assign_role_perm($role_id, $perm_id)
    {
        return $this->model_rbac_assigning->assign_role_perm($role_id, $perm_id);
    }

    /**
     * Assign permissions to a role
     * @param $role_id
     * @param $perms_id
     * @return bool
     */
    public function assign_role_perms($role_id, $perms_id)
    {
        try
        {
            //Assign each permission to that role
            foreach ($perms_id as $row)
            {
                $this->assign_role_perm($role_id, $row);
            }
        } catch (\Exception $e)
        {
            IrbsException::write_log('error', $e);
            return false;
        }
        return true;

    }

    /**
     * Assign roles to a permission
     * @param $roles_id
     * @param $perm_id
     * @return bool
     */
    public function assign_perm_roles($perm_id, $roles_id)
    {
        try
        {
            //Assign each role to that permission
            foreach ($roles_id as $row)
            {
                $this->assign_role_perm($row, $perm_id);
            }
        } catch (\Exception $e)
        {
            IrbsException::write_log('error', $e);
            return false;
        }
        return true;

    }

    /**
     * Unassign a permission of a role
     * @param $role_id
     * @param $perm_id
     * @return bool
     */
    public function unassign_role_perm($role_id, $perm_id)
    {
        return $this->model_rbac_assigning->unassign_role_perm($role_id, $perm_id);
    }

    /**
     * Unassign all permissions of a role
     * @param $role_id
     * @return bool
     */
    public function unassign_role_perms($role_id)
    {
        return $this->model_rbac_assigning->unassign_role_perms($role_id);
    }

    /**
     * Unassign all roles of a permission
     * @param $perm_id
     * @return bool
     */
    public function unassign_perm_roles($perm_id)
    {
        return $this->model_rbac_assigning->unassign_perm_roles($perm_id);
    }

    /**
     * Assign a role to an account
     * @param $role_id
     * @param $acc_id
     * @return bool
     */
    public function assign_acc_role($role_id, $acc_id)
    {
        return $this->model_rbac_assigning->assign_acc_role($role_id, $acc_id);
    }

    /**
     * Assign roles to an account
     * @param $roles_id
     * @param $acc_id
     * @return bool
     */
    public function assign_acc_roles($acc_id, $roles_id)
    {
        return $this->model_rbac_assigning->assign_acc_roles($acc_id, $roles_id);
    }

    /**
     * Assign accounts to a role
     * @param $role_id
     * @param $accs_id
     * @return bool
     */
    public function assign_role_accs($role_id, $accs_id)
    {
        try
        {
            //Assign each account to that role
            foreach ($accs_id as $row)
            {
                $this->assign_acc_role($role_id, $row);
            }
        } catch (\Exception $e)
        {
            IrbsException::write_log('error', $e);
            return false;
        }
        return true;
    }

    /**
     * Unassign a role of an account
     * @param $role_id
     * @param $acc_id
     * @return bool
     */
    public function unassign_acc_role($role_id, $acc_id)
    {
        return $this->model_rbac_assigning->unassign_acc_role($role_id, $acc_id);
    }

    /**
     * Unassign all roles of an account
     * @param $acc_id
     * @return bool
     */
    public function unassign_acc_roles($acc_id)
    {
        return $this->model_rbac_assigning->unassign_acc_roles($acc_id);
    }

    /**
     * Unassign all accounts of a role
     * @param $role_id
     * @return bool
     */
    public function unassign_role_accs($role_id)
    {
        return $this->model_rbac_assigning->unassign_role_perms($role_id);
    }


    /**
     * Get all permissions information that assigned to a role
     * @param $role_id
     * @return array
     */
    public function get_role_assigned_perms($role_id)
    {
        return $this->model_rbac_assigning->get_role_assigned_perms($role_id);
    }

    /**
     * Get all permission titles that assigned to a role
     * @param $role_id
     * @return array
     */
    public function get_role_assigned_perms_title($role_id)
    {
        //Get all assigned permissions information
        $perms = $this->get_role_assigned_perms($role_id);
        //Extract titles from obtained information array
        $result = array();
        if ($perms)
        {
            foreach ($perms as $row)
            {
                $result[] = $row['Title'];
            }
        }
        return $result;
    }



    /**
     * Get all permissions that assigned to a role and then format them as html
     * @param $role_id
     * @return array
     */
    public function get_role_assigned_perms_html($role_id)
    {
        //Get all assigned permissions information from database
        $perms = $this->get_role_assigned_perms_title($role_id);

        //Transform them into html (string format)
        $result = '';
        foreach ($perms as $row)
        {
            $result .= '<p>';
            $result .= $row;
            $result .= '</p>';
        }
        //TODO display assigned perms list as tree (or breadcrumb) structure
        return $result;
    }

    /**
     * @param $acc_id
     * @return mixed
     */
    public function get_acc_assigned_roles($acc_id)
    {
        return $this->model_rbac_assigning->get_acc_assigned_roles($acc_id);
    }

    /**
     * Get name of all roles assigned to this account
     * @param $acc_id
     * @return array
     */
    public function get_acc_assigned_roles_name($acc_id)
    {
        //Get all assigned roles information from database
        $roles = $this->get_acc_assigned_roles($acc_id);
        //Append node titles to result
        $result = array();
        if ($roles)
        {
            foreach ($roles as $row)
            {
                $result[] = $row['Title'];
            }
        }
        return $result;
    }

    /**
     * Get id of all roles assigned to this account
     * @param $acc_id
     * @return array
     */
    public function get_acc_assigned_roles_id($acc_id)
    {
        //Get all assigned roles information from database
        $roles = $this->get_acc_assigned_roles($acc_id);

        //Append node id to result
        $result = array();
        if ($roles)
        {
            foreach ($roles as $row)
            {
                $result[] = $row['ID'];
            }
        }
        return $result;
    }

    /**
     * Get all assigned role names of an account and then transform into html
     * @param $acc_id
     * @return string
     */
    public function get_acc_assigned_roles_html($acc_id)
    {
        //Get all assigned roles information from database
        $roles = $this->get_acc_assigned_roles_name($acc_id);

        //Transform them into html (string format)
        $result = '';
        foreach ($roles as $row)
        {
            $result .= '<p>';
            $result .= $row;
            $result .= '</p>';
        }
        return $result;
    }
} 