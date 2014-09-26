<?php
namespace super_classes;

/**
 * Interface HandleFeedbackBehavior
 * @package super_classes1
 */
interface HandleFeedbackBehavior
{
    /**
     * @param $feedback_info
     * @return mixed
     */
    function handle_feedback($feedback_info);
}
