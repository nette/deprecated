<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

if (!function_exists('dlog')) {
	/**
	 * Tracy\Debugger::log() shortcut.
	 * @deprecated
	 */
	function dlog($var = null)
	{
		trigger_error(__FUNCTION__ . '() is deprecated.', E_USER_DEPRECATED);
		if (func_num_args() === 0) {
			Tracy\Debugger::log(new Exception, 'dlog');
		}
		foreach (func_get_args() as $arg) {
			Tracy\Debugger::log($arg, 'dlog');
		}
		return $var;
	}
}


if (!function_exists('callback')) {
	/**
	 * Nette\Callback factory.
	 * @param  mixed   class, object, callable
	 * @param  string  method
	 * @return Nette\Callback
	 * @deprecated
	 */
	function callback($callback, $m = null)
	{
		trigger_error(__FUNCTION__ . '() is deprecated; use native PHP callback.', E_USER_DEPRECATED);
		return new Nette\Callback($callback, $m);
	}
}
