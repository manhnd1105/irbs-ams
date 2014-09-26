<?php
namespace super_classes;

/**
 * Interface ProcessOrderBehavior
 * @package super_classes1
 */
interface ProcessOrderBehavior
{
    /**
     * @param $order_info
     * @return mixed
     */
    function process_order($order_info);
}
