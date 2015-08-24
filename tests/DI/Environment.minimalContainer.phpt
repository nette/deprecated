<?php

/**
 * Test: Nette\Environment minimal usage.
 */

use Nette\Environment;
use Tester\Assert;


require __DIR__ . '/../bootstrap.php';


Assert::null(Environment::getVariable('foo', NULL), "Getting variable 'foo':");


Assert::exception(function () {
	Environment::getVariable('foo');
}, Nette\InvalidStateException::class, "Unknown environment variable 'foo'.");


test(function () {
	// Defining constant 'APP_DIR':
	Environment::setVariable('appDir', '/myApp');
	Assert::same('/myApp', Environment::getVariable('appDir'));


	// Setting variable 'test'...
	Environment::setVariable('test', '%appDir%/test');
	Assert::same('/myApp/test', Environment::getVariable('test'));
});


test(function () {
	// Services
	Assert::same(Nette\Http\Response::class, get_class(Environment::getHttpResponse()));
	Assert::same(Nette\Application\Application::class, get_class(Environment::getApplication()));
	Assert::same(Nette\Caching\Cache::class, get_class(Environment::getCache('my')));
});


test(function () {
	// Modes
	Assert::same(PHP_SAPI === 'cli', Environment::isConsole()); // Is console?
	Assert::true(Environment::isProduction()); // Is production mode?
});
