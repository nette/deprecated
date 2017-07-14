<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

namespace Nette;


/**
 * @deprecated
 */
abstract class FreezableObject extends Object implements IFreezable
{
	/** @var bool */
	private $frozen = false;


	/**
	 * Makes the object unmodifiable.
	 * @return void
	 */
	public function freeze()
	{
		$this->frozen = true;
	}


	/**
	 * Is the object unmodifiable?
	 * @return bool
	 */
	public function isFrozen()
	{
		return $this->frozen;
	}


	/**
	 * Creates a modifiable clone of the object.
	 * @return void
	 */
	public function __clone()
	{
		$this->frozen = false;
	}


	/**
	 * @return void
	 */
	protected function updating()
	{
		trigger_error(__CLASS__ . ' is deprecated.', E_USER_DEPRECATED);
		if ($this->frozen) {
			$class = get_class($this);
			throw new InvalidStateException("Cannot modify a frozen object $class.");
		}
	}
}
