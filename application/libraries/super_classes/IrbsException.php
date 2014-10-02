<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 9/26/14
 * Time: 11:16 AM
 */

namespace super_classes;


/**
 * Class IrbsException
 * Extends original Exception class of CI
 * @package super_classes
 */
class IrbsException extends \Exception
{
    /**
     * @param            $level
     * @param \Exception $e
     */
    public static function write_log($level, \Exception $e)
    {
        $message = 'File: ' . $e->getFile() . "\n" .
            'Line: ' . $e->getLine() . "\n" .
            'Message: ' . $e->getMessage() . "\n" .
            'Code: ' . $e->getCode() . "\n" .
            'Trace' . $e->getTraceAsString();
        log_message($level, $message);
    }

    /**
     * @param $message
     */
    public static function log_activity($message)
    {
        log_message('debug', $message);
    }
} 