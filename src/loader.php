<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

declare(strict_types=1);


if (!class_exists('Nette\Loaders\NetteLoader')) {
	require __DIR__ . '/Loaders/NetteLoader.php';
}

Nette\Loaders\NetteLoader::getInstance()->register();
