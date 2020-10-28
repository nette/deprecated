<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

declare(strict_types=1);

namespace Nette\Iterators;


/**
 * RecursiveCallbackFilterIterator for PHP < 5.4.
 * @deprecated use RecursiveCallbackFilterIterator
 */
class RecursiveFilter extends Filter implements \RecursiveIterator
{
	public function __construct(\RecursiveIterator $iterator, callable $callback)
	{
		trigger_error(self::class . ' is deprecated, use RecursiveCallbackFilterIterator.', E_USER_WARNING);
		parent::__construct($iterator, $callback);
	}


	public function hasChildren()
	{
		return $this->getInnerIterator()->hasChildren();
	}


	public function getChildren()
	{
		return new static($this->getInnerIterator()->getChildren(), $this->callback);
	}
}
