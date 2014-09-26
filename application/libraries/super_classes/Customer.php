<?php
namespace super_classes;

/**
 * Class Customer
 * @package super_classes1
 */
class Customer extends AccountDecorator implements ConfirmOrderBehavior, PayOrderBehavior
{
    /**
     * @param $order_id
     * @return string
     */
    /*    public function viewOrder($order_id)
        {
                     $this->load->library('rest');
                    $config = array('server' => 'http://localhost/irbs-dms/index.php/api/api_controller/');
                    $this->rest->initialize($config);
                    $order_info = $this->rest->get('order', array('id' => $order_id), 'json');
            $order_info = file_get_contents('http://localhost/irbs-dms/index.php/api/api_controller/order/id/1/format/json');
            return $order_info;
        }*/


    /**
     * @param $order_id
     * @return bool
     */
    public function confirm_order($order_id)
    {
        //TODO write content
        return true;
    }


    /**
     * @param $order_id
     * @return bool
     */
    public function pay_order($order_id)
    {
        //TODO write content
        return true;
    }

    public function get_actions()
    {
        $actions = array(
            'pay_order' => 'Pay Order',
            'confirm_order' => 'Confirm Order'
        );
        return $actions;
    }
}

