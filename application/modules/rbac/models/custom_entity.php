<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 8/27/14
 * Time: 11:36 AM
 */

/**
 * Class CustomEntity
 * Just to standardize array of information of a custom entity (role/permission)
 */
class CustomEntity
{
    /**
     * @var
     */
    private $_id;

    /**
     * @var
     */
    private $_left;

    /**
     * @var
     */
    private $_right;

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
    private $_path;

    /**
     * @var
     */
    private $_depth;

    /**
     * @var
     */
    private $_parent_id;

    /**
     * Used to assign values to properties
     * @param $info
     */
    function __construct($info)
    {
        $this->_id = $info['id'];
        $this->_left = $info['left'];
        $this->_right = $info['right'];
        $this->_title = $info['title'];
        $this->_desc = $info['desc'];
        $this->_path = $info['path'];
        $this->_depth = $info['depth'];
        $this->_parent_id = $info['parent_id'];
    }

    /**
     * Get all properties of this instance
     * @return array
     */
    public function get_props()
    {
        $props = array(
            'id' => $this->_id,
            'left' => $this->_left,
            'right' => $this->_right,
            'title' => $this->_title,
            'desc' => $this->_desc,
            'path' => $this->_path,
            'depth' => $this->_depth,
            'parent_id' => $this->_parent_id
        );
        return $props;
    }
}