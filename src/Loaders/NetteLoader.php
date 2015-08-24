<?php

/**
 * This file is part of the Nette Framework (http://nette.org)
 * Copyright (c) 2004 David Grudl (http://davidgrudl.com)
 */

namespace Nette\Loaders;

use Latte;
use Nette;
use Tracy;


/**
 * Nette auto loader is responsible for loading Nette classes and interfaces.
 */
class NetteLoader
{
	/** @var NetteLoader */
	private static $instance;

	/** @var array */
	public $renamed = array(
		Nette\Config\Configurator::class => Nette\Configurator::class,
		Nette\Config\CompilerExtension::class => Nette\DI\CompilerExtension::class,
		Nette\Http\User::class => Nette\Security\User::class,
		Nette\Templating\DefaultHelpers::class => Nette\Templating\Helpers::class,
		Nette\Templating\FilterException::class => Latte\CompileException::class,
		Nette\Utils\PhpGenerator\ClassType::class => Nette\PhpGenerator\ClassType::class,
		Nette\Utils\PhpGenerator\Helpers::class => Nette\PhpGenerator\Helpers::class,
		Nette\Utils\PhpGenerator\Method::class => Nette\PhpGenerator\Method::class,
		Nette\Utils\PhpGenerator\Parameter::class => Nette\PhpGenerator\Parameter::class,
		Nette\Utils\PhpGenerator\PhpLiteral::class => Nette\PhpGenerator\PhpLiteral::class,
		Nette\Utils\PhpGenerator\Property::class => Nette\PhpGenerator\Property::class,
		Nette\Diagnostics\Bar::class => Tracy\Bar::class,
		Nette\Diagnostics\BlueScreen::class => Tracy\BlueScreen::class,
		Nette\Diagnostics\DefaultBarPanel::class => Tracy\DefaultBarPanel::class,
		Nette\Diagnostics\Dumper::class => Tracy\Dumper::class,
		Nette\Diagnostics\FireLogger::class => Tracy\FireLogger::class,
		Nette\Diagnostics\Logger::class => Tracy\Logger::class,
		Nette\Diagnostics\OutputDebugger::class => Tracy\OutputDebugger::class,
		Nette\Latte\ParseException::class => Latte\CompileException::class,
		Nette\Latte\CompileException::class => Latte\CompileException::class,
		Nette\Latte\Compiler::class => Latte\Compiler::class,
		Nette\Latte\HtmlNode::class => Latte\HtmlNode::class,
		Nette\Latte\IMacro::class => Latte\IMacro::class,
		Nette\Latte\MacroNode::class => Latte\MacroNode::class,
		Nette\Latte\MacroTokens::class => Latte\MacroTokens::class,
		Nette\Latte\Parser::class => Latte\Parser::class,
		Nette\Latte\PhpWriter::class => Latte\PhpWriter::class,
		Nette\Latte\Token::class => Latte\Token::class,
		Nette\Latte\Macros\CoreMacros::class => Latte\Macros\CoreMacros::class,
		Nette\Latte\Macros\MacroSet::class => Latte\Macros\MacroSet::class,
		Nette\Latte\Macros\CacheMacro::class => Nette\Bridges\CacheLatte\CacheMacro::class,
		Nette\Latte\Macros\FormMacros::class => Nette\Bridges\FormsLatte\FormMacros::class,
		Nette\Latte\Macros\UIMacros::class => Nette\Bridges\ApplicationLatte\UIMacros::class,
		Nette\ArrayHash::class => Nette\Utils\ArrayHash::class,
		Nette\ArrayList::class => Nette\Utils\ArrayList::class,
		Nette\DateTime::class => Nette\Utils\DateTime::class,
		Nette\Image::class => Nette\Utils\Image::class,
		Nette\ObjectMixin::class => Nette\Utils\ObjectMixin::class,
		Nette\Utils\NeonException::class => Nette\Neon\Exception::class,
		Nette\Utils\NeonEntity::class => Nette\Neon\Entity::class,
		Nette\Utils\Neon::class => Nette\Neon\Neon::class,
	);

	/** @var array */
	public $list = array();


	/**
	 * Returns singleton instance with lazy instantiation.
	 * @return NetteLoader
	 */
	public static function getInstance()
	{
		if (self::$instance === NULL) {
			self::$instance = new static;
		}
		return self::$instance;
	}


	/**
	 * Register autoloader.
	 * @param  bool  prepend autoloader?
	 * @return void
	 */
	public function register($prepend = FALSE)
	{
		spl_autoload_register(array($this, 'tryLoad'), TRUE, (bool) $prepend);
	}


	/**
	 * Handles autoloading of classes or interfaces.
	 * @param  string
	 * @return void
	 */
	public function tryLoad($type)
	{
		$type = ltrim($type, '\\');
		if (isset($this->renamed[$type])) {
			class_alias($this->renamed[$type], $type);
			trigger_error("Class $type has been renamed to {$this->renamed[$type]}.", E_USER_WARNING);

		} elseif (isset($this->list[$type])) {
			require __DIR__ . '/../' . $this->list[$type] . '.php';

		} elseif (substr($type, 0, 6) === 'Nette\\' && is_file($file = __DIR__ . '/../' . strtr(substr($type, 5), '\\', '/') . '.php')) {
			require $file;
		}
	}

}
