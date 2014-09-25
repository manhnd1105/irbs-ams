<?php
namespace super_classes;

/**
 * Class Level
 * @package super_classes
 */
class Level extends OrderComponent
{
    /**
     * @var
     */
    var $_level;

    /**
     * @param $info
     */
    public function set_level($info)
    {
        $this->_level = $this->init_set($info, 'level');
    }

    /**
     * @return mixed
     */
    public function get_level()
    {
        return $this->_level;
    }
}