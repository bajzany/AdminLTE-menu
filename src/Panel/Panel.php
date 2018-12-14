<?php
/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 * Created: 13.12.2018
 */

namespace Bajzany\LTEMenu\Panel;

use Bajzany\LTEMenu\Menu;

abstract class Panel
{

	/**
	 * @var Menu
	 */
	protected $menu;

	public function __construct(Menu $menu)
	{
		$this->menu = $menu;
	}

	/**
	 * @return Menu
	 */
	public function getMenu(): Menu
	{
		return $this->menu;
	}

	/**
	 * @param Menu $menu
	 * @return $this
	 */
	public function setMenu($menu)
	{
		$this->menu = $menu;
		return $this;
	}


}
