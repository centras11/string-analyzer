<?php

namespace Analyzer\Tests;

use ReflectionClass;

trait InvokeMethodTrait
{
    /**
     * invokes private methods
     *
     * @param $object
     * @param $methodName
     * @param array $parameters
     *
     * @return mixed
     *
     * @throws \ReflectionException
     */
    public function invokeMethod(&$object, $methodName, array $parameters = [])
    {
        $reflection = new ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
