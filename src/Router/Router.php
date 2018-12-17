<?php
/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 * Created: 17.12.2018
 */
namespace Bajzany\AdminLTE\Router;

use Bajzany\AdminLTE\Menu;
use Bajzany\AdminLTE\Panel\LeftPanel\Group;
use Bajzany\AdminLTE\Panel\LeftPanel\Item;

class Router
{

	/**
	 * @var Menu
	 */
	private $menu;

	/**
	 * @var Item|null
	 */
	private $selectedItem;

	/**
	 * @var Item[]
	 */
	private $items = [];

	/**
	 * @var Group[]
	 */
	private $group = [];

	/**
	 * @param Menu $menu
	 * @param null $selectedItem
	 * @param Item[] $items
	 * @param Group[] $groups
	 */
	public function __construct(Menu $menu, $selectedItem = NULL, array $items = [], array $groups = [])
	{
		$this->menu = $menu;
		$this->items = $items;
		$this->group = $groups;
		$this->selectedItem = $selectedItem;
	}

	/**
	 * @return Item|null
	 */
	public function getSelectedItem(): ?Item
	{
		return $this->selectedItem;
	}

	public function getBreadCrumb()
	{
		$list = [];
		if ($this->selectedItem) {
			$list = $this->sortBreadCrumbArray($this->selectedItem, $list);

		}
		asort($list);
		return $list;
	}

	private function sortBreadCrumbArray(Item $item, array $list = [])
	{
		$list[] = $item;
		if ($item->getParentItem()) {
			return $this->sortBreadCrumbArray($item->getParentItem(), $list);
		}

		return $list;
	}

}
