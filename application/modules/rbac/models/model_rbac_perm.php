<?php
require_once __DIR__ . '/custom_entity.php';

/**
 * Created by PhpStorm.
 * User: dell
 * Date: 8/8/14
 * Time: 9:41 AM
 */
class Model_rbac_perm
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
        if (defined('PHPUNIT_TEST')) {
            $this->rbac = new \PhpRbac\Rbac('unit_test');
        }else{
            $this->rbac = new \PhpRbac\Rbac();
        }
//        parent::__construct();
    }

    /**
     * Reset all permissions to original state (only root exists)
     * @return bool
     */
    public function reset_all()
    {
        try
        {
            $this->rbac->Permissions->reset(true);
        }
        catch (Exception $e)
        {
            return false;
        }
        return true;
    }

    /**
     * Get information of a perm
     */
    public function get($id)
    {
        //Build array of information of this node
        $info = array(
            'id' => $id,
            'title' => $this->rbac->Permissions->getTitle($id),
            'desc' => $this->rbac->Permissions->getDescription($id),
            'path' => $this->rbac->Permissions->getPath($id)
            //TODO Get missing information (left, right, depth)
        );
        return $info;
    }

    /**
     * Get information of all perms
     * Adapter pattern
     * @return mixed array
     */
    public function gets()
    {
        //Get list all roles (except root)
        $root_id = $this->rbac->Permissions->rootId();
        $perms = $this->rbac->Permissions->descendants($root_id);

        //Transform each rbac role node into custom format role node
        $result = array();
        foreach ($perms as $row)
        {
            //Custom format role node
            //TODO implement by setters and getters instead of using constructor
            $this_id = $row['ID'];
            $parent = $this->rbac->Permissions->parentNode($this_id);
            $info = array(
                'id' => $this_id,
                'left' => $row['Lft'],
                'right' => $row['Rght'],
                'title' => $row['Title'],
                'desc' => $row['Description'],
                'path' => $this->rbac->Permissions->getPath($this_id),
                'depth' => $row['Depth'],
                'parent_id' => $parent['ID']
            );
            $custom_node = new CustomEntity($info);
            $result[] = $custom_node->get_props();
        }
        return $result;
    }

    /**
     * Insert new information of a perm
     * @param $info array (title, desc, parent_id)
     * @return bool
     */
    public function insert($info)
    {
        try
        {
            $this->rbac->Permissions->add($info['title'], $info['desc'], $info['parent_id']);
        } catch (Exception $e)
        {
            echo $e->getMessage();
            return false;
        }
        return true;
    }

    /**
     * Insert new information of a perm by path
     * @param $info array (title, desc, path)
     * @return bool
     */
    public function insert_by_path($info)
    {
        try
        {
            $rbac_path = $info['path'] . '/' . $info['title'];
            $this->rbac->Permissions->addPath($rbac_path, $info['desc']);
        } catch (Exception $e)
        {
            echo $e->getMessage();
            return false;
        }
        return true;
    }

    /**
     * Update basic information of a perm (id, title, description)
     * @param $info array (id, title, desc)
     * @return bool
     */
    public function modify($info)
    {
        try
        {
            $this->rbac->Permissions->edit($info['id'], $info['title'], $info['desc']);
        } catch (Exception $e)
        {
            echo $e->getMessage();
            return false;
        }
        return true;
    }

    /**
     * Assign new parent to a perm node
     * @param $info array (id, title, desc)
     * @return bool
     */
    public function modify_parent($info)
    {
        try
        {

        } catch (Exception $e)
        {
            echo $e->getMessage();
            return false;
        }
        return true;
    }

    /**
     * Update the order of a perm node between its siblings
     * @param $info array (id, title, desc)
     * @return bool
     */
    public function modify_order($info)
    {
        try
        {

        } catch (Exception $e)
        {
            echo $e->getMessage();
            return false;
        }
        return true;
    }

    /**
     * Remove information of a perm by its id
     * @param int $id
     * @return bool
     */
    public function remove($id)
    {
        try
        {
            if($id > 0){
                $this->rbac->Permissions->remove($id);
                return true;
            }

        } catch (Exception $e)
        {
            echo $e->getMessage();
            return false;
        }
        return true;
    }

    /**
     * Setup initial nodes to support testing process
     * @param $structure
     * @return bool
     */
    public function make_sample($structure)
    {
        try
        {
            foreach ($structure as $row)
            {
                $this->rbac->Permissions->addPath('/irbs/' . $row);
            }
        } catch (Exception $e)
        {
            log_message($e->getMessage());
            return false;
        }
    }
} 