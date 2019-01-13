<?php

/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 * Created: 13.12.2018
 */


namespace Bajzany\AdminLTE\Panel;

use Bajzany\AdminLTE\Exceptions\LTEException;
use Bajzany\AdminLTE\Panel\LeftPanel\Item;
use Bajzany\AdminLTE\Panel\LeftPanel\Group;
use Bajzany\AdminLTE\Router\Router;

class LeftPanel extends Panel
{

	/**
	 * @var Group[]
	 */
	private $groups = [];

	/**
	 * @var Router
	 */
	private $router;

	/**
	 * @return Group[]
	 */
	public function getGroups(): array
	{
		return $this->groups;
	}

	/**
	 * @param string $key
	 * @return Group
	 * @throws LTEException
	 */
	public function createGroup(string $key)
	{
		if ($this->issetGroup($key)) {
			throw LTEException::groupExists($key);
		}

		$this->groups[$key] = $group = new Group($key, $this);
		return $group;
	}

	/**
	 * @param string $key
	 * @return Group|null
	 */
	public function getGroup(string $key): ?Group
	{
		if ($this->issetGroup($key)) {
			return $this->groups[$key];
		}
	}

	/**
	 * @param string $key
	 * @return bool
	 */
	public function issetGroup(string $key): bool
	{
		if (array_key_exists($key, $this->groups)) {
			return TRUE;
		}
		return FALSE;
	}


	/**
	 * @param string $groupIdentification
	 * @param string $itemIdentification
	 * @return LeftPanel\Item|null
	 */
	public function getItemByIdentification(string $groupIdentification, string $itemIdentification)
	{
		$ids = explode('.', $itemIdentification);
		$groups = $this->getGroups();
		foreach ($groups as $group) {
			if ($group->getIdentification() == $groupIdentification) {
				foreach ($group->getItems() as $key => $item) {
					return $this->search($ids, $item);
				}
				break;
			}
		}

		return NULL;
	}

	/**
	 * @param array $ids
	 * @param Item $item
	 * @param int $level
	 * @return Item|null
	 */
	private function search(array $ids, Item $item, $level = 1)
	{
		if ($level == count($ids)) {
			if ($item->getIdentification() == implode('.', $ids)) {
				return $item;
			}
		}

		foreach ($item->getChildren() as $child) {
			 return $this->search($ids, $child, $level + 1);
		}

		return NULL;
	}

	/**
	 * @return Router
	 * @throws LTEException
	 */
	public function getRouter(): Router
	{
		if (!$this->getMenu()->getBuilder()->isBuilt()) {
			throw LTEException::isNotBuild();
		}
		return $this->router;
	}

	/**
	 * @param Router $router
	 * @return $this
	 */
	public function setRouter($router)
	{
		$this->router = $router;
		return $this;
	}

}
