<?php

/**
 * Test: Nette\LegacyObject extension method via interface.
 */

declare(strict_types=1);

use Nette\LegacyObject;
use Tester\Assert;


require __DIR__ . '/../bootstrap.php';


interface IFirst
{
}

interface ISecond extends IFirst
{
}

class TestClass extends LegacyObject implements ISecond
{
	public $foo = 'Hello';

	public $bar = 'World';
}


function IFirst_join(ISecond $that, $separator)
{
	return __METHOD__ . ' says ' . $that->foo . $separator . $that->bar;
}


function ISecond_join(ISecond $that, $separator)
{
	return __METHOD__ . ' says ' . $that->foo . $separator . $that->bar;
}


LegacyObject::extensionMethod('ISecond::join', 'ISecond_join');
LegacyObject::extensionMethod('IFirst::join', 'IFirst_join');

$obj = new TestClass;
Assert::same('ISecond_join says Hello*World', $obj->join('*'));

Assert::same(
	['join' => 'ISecond_join'],
	Nette\Utils\LegacyObjectMixin::getExtensionMethods('TestClass')
);

Assert::same(
	['join' => 'IFirst_join'],
	Nette\Utils\LegacyObjectMixin::getExtensionMethods('IFirst')
);

Assert::exception(function () {
	$obj = new TestClass;
	$obj->joi();
}, Nette\MemberAccessException::class, 'Call to undefined method TestClass::joi(), did you mean join()?');
