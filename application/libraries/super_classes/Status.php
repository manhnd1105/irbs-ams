<?php
namespace super_classes;

/**
 * Class Status
 * @package super_classes
 */
class Status extends OrderComponent
{
    /**
     * @var
     */
    var $_name;
    /**
     * @var
     */
    var $_description;

    /**
     * @param $info
     */
    public function set_name($info)
    {
        $this->_name = $this->init_set($info, 'name');
    }

    /**
     * @return mixed
     */
    public function get_name()
    {
        return $this->_name;
    }

    /**
     * @param $info
     */
    public function set_description($info)
    {
        $this->_description = $this->init_set($info, 'description');
    }

    /**
     * @return mixed
     */
    public function get_description()
    {
        return $this->_description;
    }
}
