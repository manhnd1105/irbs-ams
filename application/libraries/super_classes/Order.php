<?php
namespace super_classes;

/**
 * Class Order
 * @package super_classes
 */
abstract class Order
{
    /**
     * @var
     */
    var $_id;
    /**
     * @var
     */
    var $_creation_date;
    /**
     * @var
     */
    var $_description;
    /**
     * @var array
     */
    var $_components;

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
     *
     */
    function __construct()
    {
        $this->_components = array();
    }

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

    /**
     * @param OrderComponent $component_obj
     * @return mixed
     */
    abstract function add_component(OrderComponent $component_obj);

    /**
     * @param OrderComponent $component_obj
     * @return mixed
     */
    abstract function remove_component(OrderComponent $component_obj);

}
