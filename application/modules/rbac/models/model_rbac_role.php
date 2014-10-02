<?php
require_once __DIR__ . '/custom_entity.php';
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 8/8/14
 * Time: 9:41 AM
 */
class Model_rbac_role
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
     * Reset all roles in database to original state (only root exists)
     */
    public function reset_all()
    {
        try
        {
            $this->rbac->Roles->reset(true);
        } catch (\Exception $e)
        {
            \super_classes\IrbsException::write_log('error', $e);
            return false;
        }
        return true;
    }
    /**
     * Get information of a role
     */
    public function get($id)
    {
        //Build array of information of this node
        $info = array(
            'id' => $id,
            'title' => $this->rbac->Roles->getTitle($id),
            'desc' => $this->rbac->Roles->getDescription($id),
            'path' => $this->rbac->Roles->getPath($id),
            'parent_id' => $this->rbac->Roles->parentNode($id)['ID']
            //TODO Get missing information (left, right, depth)
        );
        return $info;
    }

    /**
     * Get information of all roles
     * Adapter pattern
     * @return mixed array
     */
    public function gets()
    {
        //Get list all roles (except root)
        $root_id = $this->rbac->Roles->rootId();
        $roles = $this->rbac->Roles->descendants($root_id);

        //Transform each rbac role node into custom format role node
        $result = array();
        foreach ($roles as $row)
        {
            //Custom format role node
            //TODO implement by setters and getters instead of using constructor
            $this_id = $row['ID'];
            $parent = $this->rbac->Roles->parentNode($this_id);
            $info = array(
                'id' => $this_id,
                'left' => $row['Lft'],
                'right' => $row['Rght'],
                'title' => $row['Title'],
                'desc' => $row['Description'],
                'path' => $this->rbac->Roles->getPath($this_id),
                'depth' => $row['Depth'],
                'parent_id' => $parent['ID']
            );
            $custom_node = new CustomEntity($info);
            $result[] = $custom_node->get_props();
        }
        return $result;
    }

    /**
     * Insert new information of a role
     * @param $info array (title, desc, parent_id)
     * @return mixed
     */
    public function insert($info)
    {
        try
        {
            $inserted_id = $this->rbac->Roles->add($info['title'], $info['desc'], $info['parent_id']);
        } catch (\Exception $e)
        {
            \super_classes\IrbsException::write_log('error', $e);
            return false;
        }
        return $inserted_id;
    }

    /**
     * Insert new information of a role by path
     * @param $info array (title, desc, path)
     * @return bool
     */
    public function insert_by_path($info)
    {
        try
        {
            $rbac_path = $info['path'] . '/' . $info['title'];
            $this->rbac->Roles->addPath($rbac_path, $info['desc']);
        } catch (\Exception $e)
        {
            \super_classes\IrbsException::write_log('error', $e);
            return false;
        }
        return true;
    }

    /**
     * Update basic information of a role (id, title, description)
     * @param $info array (id, title, desc)
     * @return bool
     */
    public function modify($info)
    {
        try
        {
            $this->rbac->Roles->edit($info['id'], $info['title'], $info['desc']);
        } catch (\Exception $e)
        {
            \super_classes\IrbsException::write_log('error', $e);
            return false;
        }
        return true;
    }

    /**
     * Assign new parent to a role node
     * @param $info array (id, title, desc)
     * @return bool
     */
    public function modify_parent($info)
    {
        try
        {

        } catch (Exception $e)
        {
            \super_classes\IrbsException::write_log('error', $e);
            return false;
        }
        return true;
    }

    /**
     * Update the order of a role node between its siblings
     * @param $info array (id, title, desc)
     * @return bool
     */
    public function modify_order($info)
    {
        try
        {

        } catch (\Exception $e)
        {
            \super_classes\IrbsException::write_log('error', $e);
            return false;
        }
        return true;
    }

    /**
     * Remove information of a role by its id
     * @param int $id
     * @return bool
     */
    public function remove($id)
    {
        try
        {
            $this->rbac->Roles->remove($id);
        } catch (\Exception $e)
        {
            \super_classes\IrbsException::write_log('error', $e);
            return false;
        }
        return true;
    }

    /**
     * Insert a sample set of roles to database
     * @param $structure
     * @return bool
     */
    public function make_sample($structure)
    {
        try
        {
            foreach ($structure as $row)
            {
                $this->rbac->Roles->addPath('/irbs/' . $row);
            }
        } catch (\Exception $e)
        {
            \super_classes\IrbsException::write_log('error', $e);
            return false;
        }
    }

    /**
     * Setup default minimal permissions for unauthorized users to be able to log in
     * @param $unauthorized_id
     * @param $unauthorized_role_id
     * @param $authentication_perms_id
     * @return bool
     */
    public function set_unauthorized_access($unauthorized_id,
                                                   $unauthorized_role_id,
                                                   $authentication_perms_id)
    {
        try
        {
            $this->rbac->Users->assign($unauthorized_role_id, $unauthorized_id);
            foreach ($authentication_perms_id as $row)
            {
                $this->rbac->Roles->assign($unauthorized_role_id, $row);
            }

        } catch (\Exception $e)
        {
            \super_classes\IrbsException::write_log('error', $e);
            return false;
        }
        return true;
    }
}

