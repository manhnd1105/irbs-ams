<?php
namespace super_classes;

/**
 * Interface PayOrderBehavior
 * @package super_classes1
 */
interface PayOrderBehavior
{
    /**
     * @param $order_id
     * @return mixed
     */
    function pay_order($order_id);
}