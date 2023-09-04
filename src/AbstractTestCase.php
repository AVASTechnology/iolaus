<?php

namespace Avastechnology\Iolaus;

use Avastechnology\Iolaus\Traits\GenerateIntegers;
use Avastechnology\Iolaus\Traits\InvokeGetter;
use Avastechnology\Iolaus\Traits\InvokeMethod;
use Avastechnology\Iolaus\Traits\InvokeSetter;
use PHPUnit\Framework\TestCase;

/**
 * Class AbstractTestCase
 *
 */
abstract class AbstractTestCase extends TestCase
{
    use GenerateIntegers;
    use InvokeGetter;
    use InvokeSetter;
    use InvokeMethod;
}