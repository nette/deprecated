<?php

/**
 * Test: Nette\LegacyObject reflection.
 */

declare(strict_types=1);

use Tester\Assert;

require __DIR__ . '/../bootstrap.php';


class TestClass extends Nette\LegacyObject
{
}


$obj = new TestClass;
Assert::same('TestClass', $obj->getReflection()->getName());
Assert::same('TestClass', $obj->Reflection->getName());
