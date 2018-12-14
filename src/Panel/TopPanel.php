<?php

/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 * Created: 13.12.2018
 */

namespace Bajzany\LTEMenu\Panel;

use Bajzany\LTEMenu\Panel\TopPanel\ControlItem;

class TopPanel extends Panel
{

	/**
	 * @var ControlItem[]
	 */
	private $controls = [];

	/**
	 * @param ControlItem $control
	 */
	public function addControl(ControlItem $control)
	{
		$this->controls[] = $control;
	}

	/**
	 * @return ControlItem[]
	 */
	public function getControls()
	{
		return $this->controls;
	}
}
