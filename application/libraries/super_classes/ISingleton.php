<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 7/9/14
 * Time: 10:31 AM
 */

namespace super_classes;


/**
 * Interface ISingleton
 * @package super_classes
 */
interface ISingleton
{
    /**
     * @return mixed
     */
    static function get_instance();
} 