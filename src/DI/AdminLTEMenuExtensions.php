<?php
/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 * Created: 13.12.2018
 */

namespace Bajzany\AdminLTE\DI;

use Bajzany\LTEMenu\Menu;
use Bajzany\LTEMenu\MenuControl;
use Nette\Configurator;
use Nette\DI\Compiler;
use Nette\DI\CompilerExtension;

class AdminLTEMenuExtensions extends CompilerExtension
{

	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();
		$builder->addDefinition($this->prefix('menu'))
			->setFactory(Menu::class);

		$builder->addDefinition($this->prefix('menuControl'))
			->setFactory(MenuControl::class);
	}

	/**
	 * @param Configurator $configurator
	 */
	public static function register(Configurator $configurator)
	{
		$configurator->onCompile[] = function ($config, Compiler $compiler) {
			$compiler->addExtension('LTEMenu', new AdminLTEMenuExtensions());
		};
	}

}
