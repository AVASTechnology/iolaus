<?php

namespace Avastechnology\Iolaus\Traits;

/**
 * Trait GenerateIntegers
 *
 * @package Avastechnology\Iolaus\Traits
 */
trait GenerateIntegers
{
    /**
     * @param  bool  $includeNegative
     * @return \Generator
     */
    public function generateIntegers(bool $includeNegative = true): \Generator
    {
        $textFormatter = function ($int) {
            return sprintf(
                '%d (%s)',
                $int,
                trim(chunk_split(str_pad(decbin($int), PHP_INT_SIZE * 8,'0', STR_PAD_LEFT), 8, ' '))
            );
        };

        if ($includeNegative) {
            $int = \PHP_INT_MIN;
            while ($int < -1) {
                yield $int => $textFormatter($int);
                $int = ($int >> 1);
            }

            yield -1 => $textFormatter(-1);
        }

        $int = 1;

        while ($int < \PHP_INT_MAX && $int !== 0) {
            yield $int - 1 => $textFormatter($int - 1);
            yield $int => $textFormatter($int);
            $int = ($int << 1);
        }
    }
}