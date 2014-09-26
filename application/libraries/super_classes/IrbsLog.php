<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 9/26/14
 * Time: 11:16 AM
 */

namespace super_classes;


class IrbsException extends \Exception
{
    public static function write_log($level, \Exception $e)
    {
        $message = 'File: ' . $e->getFile() . "\n" .
            'Line: ' . $e->getLine() . "\n" .
            'Message: ' . $e->getMessage() . "\n" .
            'Code: ' . $e->getCode() . "\n" .
            'Trace' . $e->getTraceAsString();
        log_message($level, $message);
    }
} 