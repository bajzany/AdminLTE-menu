<?php
/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 * Created: 13.12.2018
 */

namespace Bajzany\AdminLTE\Panel\LeftPanel;

/**
 * Class Item
 * @package Bajzany\Menu
 * @author Radek Zika <radek.zika@dipcom.cz>
 */
class Icon
{

	/**
	 * @var string
	 */
	private $fontAwesome = 'fa fa-dashboard';

	/**
	 * @var string
	 */
	private $iconColor = 'white';

	/**
	 * @return string
	 */
	public function getIconColor(): string
	{
		return $this->iconColor;
	}

	/**
	 * @param string $iconColor
	 * @return $this
	 */
	public function setIconColor($iconColor)
	{
		$this->iconColor = $iconColor;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getFontAwesome(): string
	{
		return $this->fontAwesome;
	}

	/**
	 * @param string $fontAwesome
	 * @return $this
	 */
	public function setFontAwesome($fontAwesome)
	{
		$this->fontAwesome = $fontAwesome;
		return $this;
	}

}
