<?php
/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 * Created: 13.12.2018
 */

namespace Bajzany\AdminLTE;

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

	/**
	 * @param string $type
	 */
	private function setDefault(string $type)
	{
		$this->menu->build($type);
		$this->template->menu = $this->menu;
		$this->template->setTranslator($this->getTranslator());
	}

	/**
	 * @param string $type
	 */
	public function renderTop(string $type = 'admin')
	{
		$this->setDefault($type);
		$this->template->setFile(__DIR__ . '/templates/topPanel.latte');
		$this->template->render();
	}

	/**
	 * @param string $type
	 */
	public function renderLeft(string $type = 'admin')
	{
		$this->setDefault($type);
		$this->template->setFile(__DIR__ . '/templates/leftPanel.latte');
		$this->template->render();
	}

	/**
	 * @param string $type
	 * @throws Exceptions\LTEException
	 */
	public function renderBreadcrumb(string $type = 'admin')
	{
		$this->setDefault($type);
		$this->template->breadCrumb = $this->menu->getLeftPanel()->getRouter()->getBreadCrumb();
		$this->template->setFile(__DIR__ . '/templates/breadcrumb.latte');
		$this->template->render();
	}

	public function getComponent($name, $throw = TRUE)
	{
		$this->menu->build();
		return parent::getComponent($name, $throw);
	}

}
