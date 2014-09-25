<?php
namespace super_classes;

/**
 * Class Feedback
 * @package super_classes
 */
class Feedback extends OrderComponent
{
    /**
     * @var
     */
    var $_creation_date;
    /**
     * @var
     */
    var $_name;

    /**
     * @param $info
     */
    public function set_creation_date($info)
    {
        $this->_creation_date = $this->init_set($info, 'creation_date');
    }

    /**
     * @return mixed
     */
    public function get_creation_date()
    {
        return $this->_creation_date;
    }

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
}