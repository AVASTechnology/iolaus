<?php

namespace Avastechnology\Iolaus\Traits;

/**
 * Trait InvokeMethod
 *
 * @package Avastechnology\Iolaus
 */
trait InvokeMethod
{
    /**
     * @param  string|object  $object
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     * @throws \ReflectionException
     */
    public function invokeMethod(string|object $object, string $method, array $parameters = []): mixed
    {
        if (is_object($object)) {
            // set object property
            $reflectedClass = new \ReflectionObject($object);
        } else {
            // set static property
            $reflectedClass = new \ReflectionClass($object);
        }

        $reflectedMethod = $reflectedClass->getMethod($method);

        return $reflectedMethod->invoke(
            ($reflectedMethod->isStatic() ? null : $object),
            ...$parameters
        );
    }
}
