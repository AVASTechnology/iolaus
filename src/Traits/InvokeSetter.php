<?php

namespace Avastechnology\Iolaus\Traits;

use ReflectionException;

/**
 * Trait InvokeSetter
 *
 * @package Avastechnology\Iolaus\Traits
 */
trait InvokeSetter
{
    /**
     * @param  string|object  $object
     * @param  string  $property
     * @param  mixed  $value
     * @param  bool  $dynamic
     * @throws ReflectionException
     */
    public function invokeSetter(string|object $object, string $property, mixed $value, bool $dynamic = false): void
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
                $reflectedProperty->setValue($value);
            } else {
                $reflectedProperty->setValue($object, $value);
            }
        } elseif ($dynamic && is_object($object)) {
            $object->{$property} = $value;
        } else {
            throw new \InvalidArgumentException(
                sprintf(
                    'Unable to find property of object "%s"',
                    $reflectedClass->name
                )
            );
        }
    }
}