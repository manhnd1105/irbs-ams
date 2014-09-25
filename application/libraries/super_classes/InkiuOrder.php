<?php
namespace super_classes;


/**
 * Class InkiuOrder
 * @package super_classes
 */
class InkiuOrder extends Order
{
    /**
     * @var
     */
    var $_creator;

    /**
     * @param $info
     */
    public function set_creator($info)
    {
        $this->_creator = $this->init_set($info, 'creator');
    }

    /**
     * @return mixed
     */
    public function get_creator()
    {
        return $this->_creator;
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
     * @return array
     */
    public function get_props()
    {
        $props = array(
            'creator' => $this->_creator,
            'creation_date' => $this->_creation_date,
            'description' => $this->_description,
            'components' => $this->_components,
            'id' => $this->_id
        );
        return $props;
    }

    /**
     * @param OrderComponent $component_obj
     * @return mixed|void
     */
    public function remove_component(OrderComponent $component_obj = NULL)
    {
        if ($component_obj === NULL) {
            //Remove all components
            $this->_components = array();
        } else {
            //Search whether the selected obj exists in array of this instance
            foreach ($this->_components as $existing_component) {
                if ($component_obj->_component_name === $existing_component->_component_name) {
                    unset($this->_components[$component_obj]);
                }
            }
        }
    }

    /**
     * @param OrderComponent $component_obj
     * @return bool|mixed
     */
    public function add_component(OrderComponent $component_obj)
    {
        $this->_components[] = $component_obj;
        return true;
    }
}

