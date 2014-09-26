<?php
namespace super_classes;

/**
 * Interface ConfirmOrderBehavior
 * @package super_classes1
 */
interface ConfirmOrderBehavior
{
    /**
     * @param $order_id
     * @return mixed
     */
    function confirm_order($order_id);
}