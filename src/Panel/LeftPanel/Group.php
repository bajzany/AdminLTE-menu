<?php
/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 * Created: 14.12.2018
 */

namespace Bajzany\AdminLTE\Panel\LeftPanel;

use Bajzany\AdminLTE\Exceptions\LTEException;
use Bajzany\AdminLTE\Menu;
use Bajzany\AdminLTE\Panel\LeftPanel;

class Group
{

	/**
	 * @var string|null
	 */
	private $identification;

	/**
	 * @var string
	 */
	private $title;

	/**
	 * @var bool
	 */
	private $active = FALSE;

	/**
	 * @var Menu
	 */
	private $menu;

	/**
	 * @var Item[]
	 */
	private $items = [];

	/**
	 * @var LeftPanel
	 */
	private $topPanel;

	public function __construct(string $identification, LeftPanel $topPanel)
	{
		$this->identification = $identification;
		$this->topPanel = $topPanel;
	}

	/**
	 * @return Item[]
	 */
	public function getItems(): array
	{
		return $this->items;
	}

	/**
	 * @param string $identification
	 * @return Item
	 */
	public function createItem(string $identification)
	{
		$item = new Item($this->getIdentification() . '.' . $identification, $this);
		$this->items[] = $item;
		return $item;
	}

	/**
	 * @return string
	 */
	public function getTitle(): ?string
	{
		return $this->title;
	}

	/**
	 * @param string $title
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}

	/**
	 * @return string|null
	 */
	public function getIdentification(): ?string
	{
		return $this->identification;
	}

	/**
	 * @return bool
	 */
	public function isActive(): bool
	{
		return $this->active;
	}

	/**
	 * @param bool $active
	 * @return $this
	 */
	public function setActive(bool $active)
	{
		$this->active = $active;
		return $this;
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

	/**
	 * @return Item[]
	 * @throws \Exception
	 */
	public function getItemsList()
	{
		$list = [];
		foreach ($this->items as $item) {
			$list[$item->getIdentification()] = $item;
			$this->recursiveList($item, $list);
		}
		return $list;
	}

	/**
	 * @param Item $item
	 * @param array $list
	 * @throws \Exception
	 */
	private function recursiveList(Item $item, &$list = [])
	{
		foreach ($item->getChildren() as $child) {
			if (array_key_exists($child->getIdentification(), $list)) {
				throw LTEException::duplicityIdentification($child->getIdentification());
			}
			$list[$child->getIdentification()] = $child;
			$this->recursiveList($child, $list);
		}
	}

	/**
	 * @return LeftPanel
	 */
	public function getTopPanel(): LeftPanel
	{
		return $this->topPanel;
	}

}
