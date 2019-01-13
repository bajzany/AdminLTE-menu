<?php
/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 * Created: 13.12.2018
 */

namespace Bajzany\AdminLTE;

interface IBundleMenu
{

	/**
	 * @param Menu $menu
	 * @return int
	 */
	public function getSortPriority(Menu $menu): int;

	/**
	 * @param Menu $menu
	 */
	public function create(Menu $menu);

	/**
	 * @param Menu $menu
	 */
	public function beforeBuild(Menu $menu);

	/**
	 * @param Menu $menu
	 */
	public function afterBuild(Menu $menu);

}
