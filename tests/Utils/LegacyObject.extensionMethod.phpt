<?php

/**
 * Test: Nette\LegacyObject extension method.
 */

declare(strict_types=1);

use Tester\Assert;

require __DIR__ . '/../bootstrap.php';


class TestClass extends Nette\LegacyObject
{
	public $foo = 'Hello';

	public $bar = 'World';
}


TestClass::extensionMethod('join', $func = function (TestClass $that, $separator) {
	return $that->foo . $separator . $that->bar;
});

$obj = new TestClass;
Assert::same('Hello*World', $obj->join('*'));


Assert::same(
	['join' => $func],
	Nette\Utils\LegacyObjectMixin::getExtensionMethods('TestClass')
);

Assert::same(
	[],
	Nette\Utils\LegacyObjectMixin::getExtensionMethods('Nette\LegacyObject')
);

Assert::exception(function () {
	$obj = new TestClass;
	$obj->joi();
}, Nette\MemberAccessException::class, 'Call to undefined method TestClass::joi(), did you mean join()?');
