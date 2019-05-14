<?php

/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 */

namespace Bajzany\AdminLTE;

use Bajzany\AdminLTE\Router\Router;

trait MenuTrait
{

	/**
	 * @var Menu @inject
	 */
	public $menu;

	/**
	 * @param string $title
	 */
	public function changeCurrentBreadcrumbTitle(string $title)
	{
		$this->menu->getLeftPanel()->addOnCreateRouter(function (Router $router) use ($title) {
			$router->getSelectedItem()->setLabel($title);
		});
	}

}
