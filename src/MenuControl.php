<?php
/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 * Created: 13.12.2018
 */

namespace Bajzany\LTEMenu;

class MenuControl extends AControl
{

	/**
	 * @var Menu|null
	 */
	private $menu;

	/**
	 * @return Menu|null
	 */
	public function getMenu(): ?Menu
	{
		return $this->menu;
	}

	/**
	 * @param Menu $menu
	 */
	public function setMenu(Menu $menu)
	{
		$this->menu = $menu;
	}

	private function setDefault()
	{
		$this->menu->build();
		$this->template->menu = $this->menu;
		$this->template->setTranslator($this->getTranslator());
	}

	public function renderTop()
	{
		$this->setDefault();
		$this->template->setFile(__DIR__ . '/templates/topPanel.latte');
		$this->template->render();
	}

	public function renderLeft()
	{
		$this->setDefault();
		$this->template->setFile(__DIR__ . '/templates/leftPanel.latte');
		$this->template->render();
	}

	public function getComponent($name, $throw = TRUE)
	{
		$this->menu->build();
		return parent::getComponent($name, $throw);
	}

}
