<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

declare(strict_types=1);

namespace Nette\Utils;

use Nette;


/**
 * Mime type detector.
 *
 * @deprecated
 */
class MimeTypeDetector
{
	/**
	 * Static class - cannot be instantiated.
	 */
	final public function __construct()
	{
		throw new Nette\StaticClassException;
	}


	/**
	 * Returns the MIME content type of file.
	 */
	public static function fromFile(string $file): string
	{
		trigger_error(__METHOD__ . '() is deprecated; use finfo_file() instead.', E_USER_DEPRECATED);
		if (!is_file($file)) {
			throw new Nette\FileNotFoundException("File '$file' not found.");
		}
		$type = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file);
		return strpos($type, '/') ? $type : 'application/octet-stream';
	}


	/**
	 * Returns the MIME content type of file.
	 */
	public static function fromString(string $data): string
	{
		trigger_error(__METHOD__ . '() is deprecated; use finfo_buffer() instead.', E_USER_DEPRECATED);
		$type = finfo_buffer(finfo_open(FILEINFO_MIME_TYPE), $data);
		return strpos($type, '/') ? $type : 'application/octet-stream';
	}
}
