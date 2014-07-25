<?php

namespace jtreminio\TestExtensions;

use Silex\WebTestCase;

/**
 * Some useful methods to make testing with PHPUnit faster and more fun, with integration into Silex
 *
 * @author Juan Treminio <jtreminio@gmail.com>
 */
abstract class TestExtensionsSilex extends WebTestCase
{

    /**
     * Set protected/private attribute of object
     *
     * @param object &$object Object containing attribute
     * @param string $attributeName Attribute name to change
     * @param string $value Value to set attribute to
     *
     * @return null
     */
    public function setAttribute(&$object, $attributeName, $value)
    {
        $class = is_object($object) ? get_class($object) : $object;

        $reflection = new \ReflectionProperty($class, $attributeName);
        $reflection->setAccessible(true);
        $reflection->setValue($object, $value);
    }

    /**
     * Call protected/private method of a class.
     *
     * @param object &$object Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

}