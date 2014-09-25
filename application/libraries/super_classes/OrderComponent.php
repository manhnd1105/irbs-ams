<?php
namespace super_classes;

/**
 * Class OrderComponent
 * @package super_classes
 */
abstract class OrderComponent
{
    /**
     * @var
     */
    var $_component_name;

    protected function init_set($info, $field, $result = '')
    {
        if (is_array($info) && isset($info[$field])) {
            $result = $info[$field];
        } else if (is_string($info)) {
            $result = $info;
        }
        return $result;
    }

    public function set_component_name($info)
    {
        $this->_component_name = $this->init_set($info, 'component_name');
    }

    /**
     * @return mixed
     */
    public function get_component_name()
    {
        return $this->_component_name;
    }
}
