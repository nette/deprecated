<?php

/**
 * This file is part of the Nette Framework (http://nette.org)
 * Copyright (c) 2004 David Grudl (http://davidgrudl.com)
 */


if (!class_exists(Nette\Loaders\NetteLoader::class)) {
	require __DIR__ . '/Loaders/NetteLoader.php';
}

Nette\Loaders\NetteLoader::getInstance()->register();

class_alias(Nette\Configurator::class, Nette\Config\Configurator::class);
class_alias(Nette\DI\CompilerExtension::class, Nette\Config\CompilerExtension::class);
class_alias(Tracy\Bar::class, Nette\Diagnostics\Bar::class);
class_alias(Tracy\BlueScreen::class, Nette\Diagnostics\BlueScreen::class);
class_alias(Tracy\Dumper::class, Nette\Diagnostics\Dumper::class);
class_alias(Latte\CompileException::class, Nette\Latte\CompileException::class);
class_alias(Latte\IMacro::class, Nette\Latte\IMacro::class);
class_alias(Latte\Macros\MacroSet::class, Nette\Latte\Macros\MacroSet::class);
class_alias(Nette\Utils\ArrayHash::class, Nette\ArrayHash::class);
class_alias(Nette\Utils\ArrayList::class, Nette\ArrayList::class);
class_alias(Nette\Utils\DateTime::class, Nette\DateTime::class);
class_alias(Nette\Utils\Image::class, Nette\Image::class);
class_alias(Nette\Utils\ObjectMixin::class, Nette\ObjectMixin::class);
class_alias(Nette\Neon\Exception::class, Nette\Utils\NeonException::class);
class_alias(Nette\Neon\Entity::class, Nette\Utils\NeonEntity::class);
class_alias(Nette\Neon\Neon::class, Nette\Utils\Neon::class);

require_once __DIR__ . '/shortcuts.php';
