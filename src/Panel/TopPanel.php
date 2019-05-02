<?php

/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 * Created: 13.12.2018
 */

namespace Bajzany\AdminLTE\Panel;

use Bajzany\AdminLTE\Panel\TopPanel\ControlItem;

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
		$controls = $this->controls;
		usort($controls, function ($item1, $item2) {
			return $item1->getPriority() <=> $item2->getPriority();
		});

		return $controls;
	}

}
