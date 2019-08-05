<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

declare(strict_types=1);

namespace Nette\Iterators;


/**
 * CallbackFilterIterator for PHP < 5.4.
 * @deprecated use CallbackFilterIterator
 */
class Filter extends \FilterIterator
{
	/** @var callable */
	protected $callback;


	public function __construct(\Iterator $iterator, callable $callback)
	{
		trigger_error(__CLASS__ . ' is deprecated, use CallbackFilterIterator.', E_USER_WARNING);
		parent::__construct($iterator);
		$this->callback = $callback;
	}


	public function accept()
	{
		return ($this->callback)($this->current(), $this->key(), $this);
	}
}
