<?php
/**
 * Author: Mykola Chomenko
 * Email: mykola.chomenko@dipcom.cz
 * Created: 11.01.2019
 */

namespace Bajzany\AdminLTE;

abstract class BundleMenu implements IBundleMenu
{

	/**
	 * @param Menu $menu
	 * @return int
	 */
	public function getSortPriority(Menu $menu): int
	{
		return 1;
	}

	/**
	 * @param Menu $menu
	 */
	public function beforeBuild(Menu $menu)
	{
	}

	/**
	 * @param Menu $menu
	 */
	public function afterBuild(Menu $menu)
	{
	}

}
