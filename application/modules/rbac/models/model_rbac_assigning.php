<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 9/6/14
 * Time: 9:30 AM
 */

class Model_rbac_assigning
{
    /**
     * @var PhpRbac\Rbac
     */
    private $rbac;

    /**
     * Constructor function
     */
    function __construct()
    {
        $this->rbac = new \PhpRbac\Rbac();
    }

    /**
     * Assign permission to a role
     * @param int $role_id
     * @param int $perm_id
     * @return bool
     */
    public function assign_role_perm($role_id, $perm_id)
    {
        try
        {
            //Assign selected role to selected permission
            $status = $this->rbac_roles_assign($role_id, $perm_id);
            if (!$status)
            {
                throw new Exception('Error while asking rbac Roles to assign role ' . $role_id . 'to perm ' . $perm_id);
            }

            //If the selected perm has children => Assign selected role to all children
            $perm_children = $this->rbac_perm_get_descendants($perm_id);
            $descendants_id = array();
            foreach ($perm_children as $row)
            {
                $descendants_id[] = $row['ID'];
            }

            if (count($descendants_id) > 0)
            {
//                foreach ($perm_children as $row)
//                {
//                    $status = $this->rbac_roles_assign($role_id, $row['ID']);
//                    if (!$status)
//                    {
//                        throw new Exception('Error while asking rbac Roles to assign role ' . $role_id . 'to perm ' . $row['ID']);
//                    }
//                }
                $status = $this->assign_role_perms($role_id, $descendants_id);
                if (!$status)
                {
                    throw new Exception('Error while asking rbac Roles to assign role ' . $role_id . 'to descendants perms of the perm ' . $perm_id);
                }
            }
        } catch (\Exception $e)
        {
            \super_classes\IrbsException::write_log('error', $e);
            return false;
        }
        return true;
    }

    function rbac_roles_assign($role_id, $perm_id)
    {
        return $this->rbac->Roles->assign($role_id, $perm_id);
    }
    function rbac_perm_get_descendants($perm_id)
    {
        return $this->rbac->Permissions->descendants($perm_id);
    }

    /**
     * Assign permissions to a role
     * @param int $role_id
     * @param array $perms_id
     * @return bool
     */
    public function assign_role_perms($role_id, $perms_id)
    {
        try
        {
            //Assign selected role to selected permissions
            foreach ($perms_id as $perm_id)
            {
                $this->rbac->Roles->assign($role_id, $perm_id);

                //If the selected perm has children => Assign selected role to all children
                $perm_children = $this->rbac->Permissions->descendants($perm_id);
                if (count($perm_children) > 0)
                {
                    foreach ($perm_children as $row)
                    {
                        $this->rbac->Roles->assign($role_id, $row['ID']);
                    }
                }
            }
        } catch (\Exception $e)
        {
            \super_classes\IrbsException::write_log('error', $e);
            return false;
        }
        return true;
    }

    /**
     * Assign a role to a perm
     * @param $role_id
     * @param $perm_id
     * @return bool
     */
    public function assign_perm_role($perm_id, $role_id)
    {
        return self::assign_role_perm($role_id, $perm_id);
    }

    /**
     * Unassign a role to a perm
     * @param $role_id
     * @param $perm_id
     * @return bool
     */
    public function unassign_perm_role($perm_id, $role_id)
    {
        return self::unassign_role_perm($role_id, $perm_id);
    }

    /**
     * Unassign all permissions of a role
     * @param $perm_id
     * @return bool
     */
    public function unassign_perm_roles($perm_id)
    {
        try
        {
            $this->rbac->Permissions->unassignRoles($perm_id);
        } catch (\Exception $e)
        {
            \super_classes\IrbsException::write_log('error', $e);
            return false;
        }
        return true;
    }

    /**
     * Unassign permission of a role
     * @param int $role_id
     * @param int $perm_id
     * @return bool
     */
    public function unassign_role_perm($role_id, $perm_id)
    {
        try
        {
            //Unassign selected role to selected permission
            $this->rbac->Roles->unassign($role_id, $perm_id);

            //If the selected perm has children => Unassign all children
            $perm_children = $this->rbac->Permissions->descendants($perm_id);
            if (count($perm_children) > 0)
            {
                foreach ($perm_children as $row)
                {
                    $this->rbac->Roles->unassign($role_id, $row['ID']);
                }
            }

        } catch (\Exception $e)
        {
            \super_classes\IrbsException::write_log('error', $e);
            return false;
        }
        return true;
    }

    /**
     * Unassign all permissions of a role
     * @param int $role_id
     * @return bool
     */
    public function unassign_role_perms($role_id)
    {
        try
        {
            $this->rbac->Roles->unassignPermissions($role_id);
        } catch (\Exception $e)
        {
            \super_classes\IrbsException::write_log('error', $e);
            return false;
        }
        return true;
    }

    /**
     * Assign role to an account
     * @param int $role_id
     * @param int $acc_id
     * @return bool
     */
    public function assign_acc_role($role_id, $acc_id)
    {
        try
        {
            //Assign selected roles to an account
            $this->rbac->Users->assign($role_id, $acc_id);
        } catch (\Exception $e)
        {
            \super_classes\IrbsException::write_log('error', $e);
            return false;
        }
        return true;
    }

    /**
     * Assign roles to an account
     * @param array $roles_id
     * @param int $acc_id
     * @return bool
     */
    public function assign_acc_roles($acc_id, $roles_id)
    {
        try
        {
            foreach ($roles_id as $role_id)
            {
                $this->rbac->Users->assign($role_id, $acc_id);

            }
        } catch (\Exception $e)
        {
            \super_classes\IrbsException::write_log('error', $e);
            return false;
        }
        return true;
    }

    /**
     * Unassign a role of an account
     * @param int $role_id
     * @param int $acc_id
     * @return bool
     */
    public function unassign_acc_role($role_id, $acc_id)
    {
        try
        {
            //Assign selected roles to an account
            $this->rbac->Users->unassign($role_id, $acc_id);
        } catch (\Exception $e)
        {
            \super_classes\IrbsException::write_log('error', $e);
            return false;
        }
        return true;
    }

    /**
     * Unassign all roles of an account
     * @param int $acc_id
     * @return bool
     */
    public function unassign_acc_roles($acc_id)
    {
        try
        {
            $roles_id = $this->rbac->Users->allRoles($acc_id);
            foreach ($roles_id as $row)
            {
                $this->rbac->Users->unassign($row, $acc_id);
            }
        } catch (\Exception $e)
        {
            \super_classes\IrbsException::write_log('error', $e);
            return false;
        }
        return true;
    }

    /**
     * Get all permissions that assigned to a role
     * @param $role_id
     * @return array
     */
    public function get_role_assigned_perms($role_id)
    {
        return $this->rbac->Roles->permissions($role_id, false);
    }

    /**
     * Get all roles assigned to an account
     * @param $acc_id
     * @return array
     */
    public function get_acc_assigned_roles($acc_id)
    {
        return $this->rbac->Users->allRoles($acc_id);
    }
} 