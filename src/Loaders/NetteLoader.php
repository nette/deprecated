<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

declare(strict_types=1);

namespace Nette\Loaders;



/**
 * Nette auto loader is responsible for loading Nette classes and interfaces.
 * @deprecated
 */
class NetteLoader
{
	/** @var array */
	public $list = [];

	/** @var NetteLoader */
	private static $instance;


	/**
	 * Returns singleton instance with lazy instantiation.
	 * @return static
	 */
	public static function getInstance()
	{
		if (self::$instance === null) {
			self::$instance = new static;
		}
		return self::$instance;
	}


	/**
	 * Register autoloader.
	 * @param  bool  prepend autoloader?
	 * @return void
	 */
	public function register($prepend = false)
	{
		spl_autoload_register([$this, 'tryLoad'], true, (bool) $prepend);
	}


	/**
	 * Handles autoloading of classes or interfaces.
	 * @param  string
	 * @return void
	 */
	public function tryLoad($type)
	{
		$type = ltrim($type, '\\');
		if (isset($this->list[$type])) {
			require __DIR__ . '/../' . $this->list[$type] . '.php';

		} elseif (substr($type, 0, 6) === 'Nette\\' && is_file($file = __DIR__ . '/../' . strtr(substr($type, 5), '\\', '/') . '.php')) {
			require $file;
		}
	}
}
