<?php
namespace super_classes;

/**
 * Class Worker
 * @package super_classes1
 */
class Worker extends Account implements HandleFeedbackBehavior, ProcessOrderBehavior
{

    /**
     * @param $feedback_info
     * @return bool
     */
    public function handle_feedback($feedback_info)
    {
        //TODO write content
        return true;
    }

    /**
     * @param $order_info
     * @return bool
     */
    public function process_order($order_info)
    {
        //TODO write content
        return true;
    }

    public function get_actions()
    {
        $actions = array(
            'handle_feedback' => 'Handle Feedback',
            'process_order' => 'Process Order'
        );
        return $actions;
    }
}
