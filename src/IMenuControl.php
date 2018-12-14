<?php
/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 * Created: 13.12.2018
 */

namespace Bajzany\AdminLTE;

interface IMenuControl
{

	/**
	 * @return MenuControl
	 */
	public function create(): MenuControl;

}
