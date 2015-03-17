<?php

/**
 * Test: Nette\Caching\Storages\PhpFileStorage test.
 */

use Nette\Caching\Cache,
	Nette\Caching\Storages\PhpFileStorage,
	Tester\Assert;


require __DIR__ . '/../bootstrap.php';


$key = 'nette';
$value = '<?php echo "Hello World" ?>';

$cache = new Cache(new PhpFileStorage(TEMP_DIR));


Assert::null( $cache->load($key) );

// Writing cache...
$cache->save($key, $value);

$var = $cache->load($key);
Assert::type( 'array', $var );
Assert::truthy( preg_match('#[0-9a-f]+\.php\z#', $var['file']) );
Assert::type( 'resource', $var['handle'] );

// Test include

ob_start();
include $var['file'];
Assert::same( 'Hello World', ob_get_clean() );

fclose($var['handle']);
