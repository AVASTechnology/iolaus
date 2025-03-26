<?php

namespace Avastechnology\Iolaus\Traits;

/**
 * Trait GenerateArrays
 *
 * @package Avastechnology\Iolaus\Traits
 */
trait GenerateArrays
{
    /**
     * @return \Generator
     */
    public static function generateArrays(): \Generator
    {
        yield static::makeList();
        yield static::makeAssociativeArray();
    }

    /**
     * @param int $entryCount
     * @return array
     */
    public static function makeList(int $entryCount = 5): array
    {
        $list = [];

        for ($i=0; $i < $entryCount; $i++) {
            $list[] = sprintf('entry-%d', $i);
        }

        return $list;
    }

    /**
     * @param int $entryCount
     * @return array
     */
    public static function makeAssociativeArray(int $entryCount = 5): array
    {
        $associativeArray = [];

        for ($i=0; $i < $entryCount; $i++) {
            $associativeArray[chr($i +  97)] = chr($i +  65);
        }

        return $associativeArray;
    }

    /**
     * @param int $entryCount
     * @return array
     */
    public static function makeMixedArray(int $entryCount = 5): array
    {
        $mixedArray = [];

        for ($i=0; $i < $entryCount; $i++) {
            if ($i % 2) {
                $mixedArray[chr($i +  97)] = chr($i +  65);
            } else {
                $mixedArray[] = sprintf('entry-%d', $i);
            }
        }

        return $mixedArray;
    }
}
