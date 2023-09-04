<?php

namespace Avastechnology\Iolaus\Traits;

/**
 * Trait InvokeGetter
 *
 * @package Avastechnology\Iolaus\Traits
 */
trait InvokeGetter
{
    /**
     * @param  string|object  $object
     * @param  string  $property
     * @return mixed
     * @throws \ReflectionException
     */
    public function invokeGetter(string|object $object, string $property): mixed
    {
        if (is_object($object)) {
            // set object property
            $reflectedClass = new \ReflectionObject($object);
        } else {
            // set static property
            $reflectedClass = new \ReflectionClass($object);
        }

        if ($reflectedClass->hasProperty($property)) {
            $reflectedProperty = $reflectedClass->getProperty($property);

            if ($reflectedProperty->isStatic()) {
                return $reflectedProperty->getValue();
            } else {
                return $reflectedProperty->getValue($object);
            }
        }

        throw new \InvalidArgumentException(
            sprintf(
                'Unable to find property of object "%s"',
                $reflectedClass->name
            )
        );
    }
}