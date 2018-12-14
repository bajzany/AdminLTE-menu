<?php

/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 * Created: 13.12.2018
 */


namespace Bajzany\LTEMenu\Panel;

use App\Core\LTEMenu\src\Panel\LeftPanel\Group;
use Bajzany\LTEMenu\Panel\LeftPanel\Item;

class LeftPanel extends Panel
{

	/**
	 * @var Group[]
	 */
	private $groups = [];

	/**
	 * @return Group[]
	 */
	public function getGroups(): array
	{
		return $this->groups;
	}

	/**
	 * @param Group $group
	 */
	public function addGroup(Group $group)
	{
		$this->groups[] = $group;
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

}
