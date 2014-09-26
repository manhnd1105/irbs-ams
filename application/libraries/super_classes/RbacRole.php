<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 8/8/14
 * Time: 9:29 AM
 */

namespace super_classes;


/**
 * Class RbacRole
 * @package super_classes
 */
class RbacRole
{
    /**
     * @var
     */
    private $_id;
    /**
     * @var
     */
    private $_title;
    /**
     * @var
     */
    private $_desc;

    /**
     * @var
     */
    private $_parent_id;

    /**
     * @param $info
     */
    public function set_parent_id($info)
    {
        $this->_parent_id = $this->init_set($info, 'parent_id');
    }

    /**
     * @return mixed
     */
    public function get_parent_id()
    {
        return $this->_parent_id;
    }
    /**
     * @param $info
     */
    public function set_id($info)
    {
        $this->_id = $this->init_set($info, 'id');
    }

    /**
     * @return mixed
     */
    public function get_id()
    {
        return $this->_id;
    }

    /**
     * @param $info
     */
    public function set_title($info)
    {
        $this->_title = $this->init_set($info, 'title');
    }

    /**
     * @return mixed
     */
    public function get_title()
    {
        return $this->_title;
    }

    /**
     * @param $info
     */
    public function set_desc($info)
    {
        $this->_desc = $this->init_set($info, 'desc');
    }

    /**
     * @return mixed
     */
    public function get_desc()
    {
        return $this->_desc;
    }

    /**
     * @param $info
     * @param $field
     * @param string $result
     * @return string
     */
    protected function init_set($info, $field, $result = '')
    {
        if (is_array($info) && isset($info[$field])) {
            $result = $info[$field];
        } else if (is_string($info)) {
            $result = $info;
        }
        return $result;
    }

    /**
     * @return array
     */
    public function get_props()
    {
        $props = array(
            'id' => $this->_id,
            'title' => $this->_title,
            'desc' => $this->_desc,
            'parent_id' => $this->_parent_id
        );
        return $props;
    }
} 