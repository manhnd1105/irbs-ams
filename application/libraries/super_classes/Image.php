<?php
namespace super_classes;

/**
 * Class Image
 * @package super_classes
 */
class Image extends OrderComponent
{
    /**
     * @var
     */
    var $_link;

    /**
     * @param $info
     */
    public function set_link($info)
    {
        $this->_link = $this->init_set($info, 'link');
    }

    /**
     * @return mixed
     */
    public function get_link()
    {
        return $this->_link;
    }
}

