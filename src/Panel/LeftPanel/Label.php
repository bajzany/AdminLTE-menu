<?php
/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 * Created: 13.12.2018
 */

namespace Bajzany\LTEMenu\Panel\LeftPanel;

/**
 * Class Item
 * @package Bajzany\Menu
 * @author Radek Zika <radek.zika@dipcom.cz>
 */
class Label
{

	/**
	 * @var string
	 */
	private $text;

	/**
	 * @var string
	 */
	private $textColor = 'white';

	/**
	 * @var string
	 */
	private $backGroundColor = 'red';

	/**
	 * @return string
	 */
	public function getText(): string
	{
		return $this->text;
	}

	/**
	 * @param string $text
	 * @return $this
	 */
	public function setText($text)
	{
		$this->text = $text;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getTextColor(): string
	{
		return $this->textColor;
	}

	/**
	 * @param string $textColor
	 * @return $this
	 */
	public function setTextColor($textColor)
	{
		$this->textColor = $textColor;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getBackGroundColor(): string
	{
		return $this->backGroundColor;
	}

	/**
	 * @param string $backGroundColor
	 * @return $this
	 */
	public function setBackGroundColor($backGroundColor)
	{
		$this->backGroundColor = $backGroundColor;
		return $this;
	}

}
